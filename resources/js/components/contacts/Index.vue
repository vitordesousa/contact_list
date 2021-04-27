<template>
	<div>
		<div class="row p-3">

			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<a href="/contacts/create" class="btn btn-outline-success btn-sm float-right">
					<i class="fas fa-plus-circle"></i> Adicionar
				</a>
			</div>

			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<b-table striped hover :items="contacts" :fields="fields" :show-empty="true">
		
					<template  v-slot:cell(id)="data">
						<div>{{ data.item.id }}</div>
					</template>

					<template  v-slot:cell(name)="data">
						<div>{{ data.item.name }}</div>
					</template>

					<template  v-slot:cell(actions)="data">
						<a :href="`/contacts/${data.item.id}/edit`" class="btn btn-info btn-sm" title="Editar"><i class="fas fa-edit"></i></a>
						<button @click="remove(data.item)" class="btn btn-danger btn-sm" title="Remover"><i class="fas fa-trash"></i> </button>
					</template>

					<template slot="empty">
						<p class="alert alert-info text-center">Ainda não há registros.</p>
					</template>
				</b-table>
			</div>
		</div>
	</div>
</template>

<script>
	import Swal from 'sweetalert2'

	export default {
		props: ['contacts'],
		data() {
			return {
				fields: [
					{ key: 'id', sortable: true, label: 'ID' },
					{ key: 'name', sortable: true, label: 'Nome' },
					{ key: 'actions' }
				]
			}
		},
		created(){
		},
		methods: {
			remove(contact) {
				Swal.fire({
					title: '',
					text: `Deseja realmente remover o contato: ${contact.name}?`,
					icon: 'warning',
					showCancelButton: true,
					confirmButtonColor: '#dc3545',
					confirmButtonText: 'Remover',
					cancelButtonText: 'Cancelar'
				}).then((result) => {
					if(result.value) {
						axios.delete(`/contacts/${contact.id}`).then((response) => {
							if(response.status === 200) {
								Swal.fire('', 'Contato removido com sucesso!', 'success')

								setTimeout(() => {
									window.location.href = "/contacts"
								}, 1500);
							}
						}).catch((e) => {
							let error = _.get(e, 'response.data.message', 'Erro ao realizar a operação')
							console.log(error)
							Swal.fire('', error, 'error')
						})
					}
				})
			}
		}
	}
</script>