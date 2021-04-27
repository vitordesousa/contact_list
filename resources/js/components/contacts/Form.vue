<template>
	<div>
		<div class="row p-3">

			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<h2 v-if="!inEdit && !inShow">Adicionar Contato</h2>
				<h2 v-if="inEdit || inShow">Editar Contato {{contactData.name}}</h2>
				
				<a :href="`/contacts/${contactData.id}/edit`" class="btn btn-warning btn-sm float-right" v-if="inShow">
					<i class="fas fa-edit"></i> Editar este contato
				</a>
			</div>

			

			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<b-form :action="getAction" method="post" class="form-horizontal" @submit.prevent="onSubmit">
					<input type="hidden" name="_token" :value="csrfToken" />
					<!-- <input v-if="this.inEdit == true" type="hidden" name="_method" value="PUT" /> -->

					<div class="row">
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
							<div class="form-group">
								<label for="name" class="label-validation">Nome [*]</label>
								<div class="input-validation">
									<input type="text" name="name" id="name" v-model="name" class="form-control" :readonly="this.inShow ? true : false" v-model.trim="$v.name.$model" placeholder="Digite o nome do contato" maxlenght="255">
								</div>

								<div class="alert alert-danger" v-if="!$v.name.required && $v.name.$dirty">O campo <strong>Nome</strong> é obrigatório.</div>
								<div class="alert alert-danger" v-if="!$v.name.minLength">O campo <strong>Nome</strong> precisa ter pelo menos <strong>{{$v.name.$params.minLength.min -2}}</strong> caracteres.</div>
								<div class="alert alert-danger" v-if="!$v.name.maxLength">O campo <strong>Nome</strong> precisa ter até <strong>{{$v.name.$params.maxLength.max-2}}</strong> caracteres.</div>

								<p v-if="errors.name" class="alert alert-danger">{{ getError(errors.name) }}</p>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
							<div class="form-group">
								<label for="contact" class="label-validation">Telefone [*]</label>
								<div class="input-validation">
									<b-form-input v-mask="['### ### ###']"  type="text" name="contact" id="contact" :readonly="this.inShow ? true : false" v-model.trim="$v.contact.$model" class="form-control" placeholder="Digite o telefone" maxlenght="9"></b-form-input>
								</div>

								<div class="alert alert-danger" v-if="!$v.contact.required && $v.contact.$dirty">O campo  <strong>Telefone</strong> é obrigatório.</div>
								<div class="alert alert-danger" v-if="!$v.contact.checkPhone">O número de telefone digitado <strong>já se encontra em nosso banco de dados</strong></div>
								<div class="alert alert-danger" v-if="!$v.contact.minLength">O campo <strong>Telefone</strong> precisa ter pelo menos <strong>{{$v.contact.$params.minLength.min -2}}</strong> caracteres.</div>
								<div class="alert alert-danger" v-if="!$v.contact.maxLength">O campo <strong>Telefone</strong> precisa ter até <strong>{{$v.contact.$params.maxLength.max-2}}</strong> caracteres.</div>
								<p v-if="errors.contact" class="alert alert-danger">{{ getError(errors.contact) }}</p>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
							<div class="form-group">
								<label for="email" class="label-validation">E-mail [*]</label>
								<div class="input-validation">
									<input type="text" name="email" id="email" v-model="email" class="form-control" :readonly="this.inShow ? true : false" v-model.trim="$v.email.$model" placeholder="Digite o e-mail" maxlenght="255">

									<div class="alert alert-danger" v-if="!$v.email.required && $v.email.$dirty">O campo  <strong>E-mail</strong> é obrigatório.</div>
									<div class="alert alert-danger" v-if="!$v.email.checkEmail">O e-mail digitado <strong>já se encontra em nosso banco de dados</strong></div>
									<div class="alert alert-danger" v-if="!$v.email.minLength">O campo <strong>E-mail</strong> precisa ter pelo menos <strong>{{$v.email.$params.minLength.min -2}}</strong> caracteres.</div>
									<div class="alert alert-danger" v-if="!$v.email.maxLength">O campo <strong>E-mail</strong> precisa ter até <strong>{{$v.email.$params.maxLength.max-2}}</strong> caracteres.</div>
								</div>

								<p v-if="errors.email" class="alert alert-danger">{{ getError(errors.email) }}</p>
							</div>
						</div>
					</div>

					<div class="row" v-if="!this.inShow">
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
							<div class="form-group has-feedback">
								<button type="submit" class="btn btn-success btn-block" id="submit" :disabled="submitStatus === 'PENDING'" >Enviar</button>
							</div>
						</div>
					</div>
					
				</b-form>
			</div>
		</div>
	</div>
</template>

<script>
	import Swal from 'sweetalert2'
	import {TheMask} from 'vue-the-mask'

	import { required, minLength, maxLength, email  } from 'vuelidate/lib/validators'
	import { checkEmail, checkPhone } from '../../../../resources/js/customValidations.js'

	export default {		
		components: {
			Swal, TheMask
		},

		props: [ 'contactData', 'errors', 'inEdit', 'inShow'],
		data() {
			return {
				submitStatus	:	null,
				name			: 	'',
				contact			: 	'',
				email			: 	'',
			}
		},
		created() {
			if (this.inEdit || this.inShow) {
				this.name			= this.contactData.name
				this.contact		= this.contactData.contact
				this.email			= this.contactData.email
			}
		},
		validations: {
			name: {
				required		,
				minLength		: minLength(5),
				maxLength		: maxLength(255)
			},
			contact: {
				required		,
				minLength		: minLength(11),
				maxLength		: maxLength(11),
				checkPhone		,
			},
			email: {
				required		,
				email 			,
				minLength		: minLength(5),
				maxLength		: maxLength(255),
				checkEmail		,
			},
		},
		methods: {
			getError(errors) {
				return _.first(errors)
			},

			checkErros() {
				if(this.$v.$invalid){
					var txt2 = '<p class="text-left"><strong>Ainda há campos que precisam de sua atenção!</strong><br><br>'

					var all = document.querySelectorAll('.alert-danger')

					for (var o = 0; o < all.length; o++) {
						txt2 += '<span class="fas fa-chevron-right"> </span> ' + all[o].innerHTML;
						if(o < all.length){
							txt2 += "<br>"
						}
					}
				
					txt2 += '</p>'

					Swal.fire({
						icon		:	'error',
						title		:	'Oops...',
						html		:	txt2
					})
				}
			},
			
			
			onSubmit() {
				this.$v.$touch()

				if (this.$v.$invalid) {
					this.submitStatus = 'ERROR'
					// show errors
					this.checkErros()
				} else {
					axios({
						method		:	this.inEdit ? 'put' : 'post',
						url 		:	this.getAction, 
						data		:	{ 
							csrfToken					:	this.csrfToken,
							name						:	this.name,
							email						:	this.email,
							contact						:	this.contact,
						}
					}).then((response) => { 
						if (response.status === 200 || response.status === 201) { 
							this.submitStatus = 'PENDING'
							Swal.fire({
								icon		:	'success',
								title		:	'Sucesso!',
								html		:	this.inEdit == true ? "Informações atualizadas com sucesso!" : "Informações inseridas com sucesso!"
							})
							setTimeout(() => {
								window.location.href = "/contacts"
							}, 1000);
						}
						return false;
					}) .catch((e) => { 
						if(Object.values(e.response.data.errors) != null && e.response.data.errors != undefined){
							var arr = Object.values(e.response.data.errors)
						} else {
							var arr = e.response.data
						}
						var txt2 = '<p class="text-left"><strong>Ainda há campos que precisam de sua atenção!</strong><br><br>'

						for (var o = 0; o < arr.length; o++) {
							txt2 += '<span class="fas fa-chevron-right"> </span> ' + arr[o];
							if(o < arr.length){
								txt2 += "<br>"
							}
						}
					
						txt2 += '</p>'

						Swal.fire({
							icon		:	'error',
							title		:	'Oops...',
							html		:	txt2
						})
					}); 
				}
			},
		},
		computed: {
			csrfToken() {
				return window.axios.defaults.headers.common['X-CSRF-TOKEN']
			},
			getAction() {
				return this.inEdit ? `/contacts/${this.contactData.id}` : '/contacts'
			}
		}
	}
</script>