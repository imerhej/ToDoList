<template>
	<div class="container">
		<div class="row justify-content-center">
	      <div class="col-md-8">
			<div class="card-header">
				Edit Sub Task
			</div>
			<div class="card">
				<div class="card-body">
					<form method="PUT" @submit.prevent="updateSubTask">
					<div class="form-group">
       					<label for="title" class="col-form-label"><b>Sub Title:</b></label>
       					<input type="text" name="title" class="form-control" id="title" v-model="subtask.title">
		                <span class="text-danger" v-if="errors.title" v-text="errors.title[0]"></span>
	   			 	</div>

		            <div class="form-group">
		                <label for="description" class="col-form-label"><b>Sub Description:</b></label>
		                <textarea class="form-control" name="description" id="description" v-model="subtask.description" ></textarea>
		                <span class="text-danger" v-if="errors.description" v-text="errors.description[0]"></span>	
		            </div>

		            <div class="form-group">
		            	<router-link :to="{name: 'show', params: {id: subtask.task_id}}" class="btn btn-sm btn-secondary">Back</router-link>
		            	<button type="submit" class="btn btn-primary btn-sm pull-right">Update Sub Task</button>
		            </div>
		        </form>
				</div>
			
			</div>
		  </div>
	    </div>
	</div>
</template>

<script>
	export default {

		data() {
			return {
				subtask: {},
				errors: {}
			}
		},

		mounted() {
			axios.post('/getSubTask/' + this.$route.params.id)
				.then(response => this.subtask = response.data)
		},

		methods: {

			updateSubTask() {
				axios.post('/updatesubtask/' + this.$route.params.id, this.$data.subtask)
				
					.then(this.onSuccess)
					.catch((error)=> this.errors = error.response.data.errors)
			},

			onSuccess(response) {
				window.location = response.data.redirect;
				this.$toasted.show('Sub Task Updated!',{ 
					 theme: "bubble", 
					 position: "top-right", 
					 duration : 3000
				})
			}
		}
	}
</script>