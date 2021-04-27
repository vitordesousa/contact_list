<template>
	<div>
		Página vindo do Vue
	</div>
</template>

<script>	
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
			console.log(this.contacts)
		},
		methods: {
		}
	}
</script>