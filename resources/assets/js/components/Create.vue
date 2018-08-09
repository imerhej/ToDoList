<template>
	<div class="container">
		<div class="row justify-content-center">
	      <div class="col-md-8">
			<div class="card-header">
				Add new Task
			</div>
			<div class="card">
				<div class="card-body">
					<form method="POST" action="/tasks" @submit.prevent="onSubmit">
						<div class="form-group">
		                <label for="title" class="col-form-label">Title:</label>
		                <input type="text" name="title" class="form-control" id="title" v-model="title" >
		                <span class="text-danger" v-if="errors.title" v-text="errors.title[0]"></span>
	                
	            		</div>
				            <div class="form-group">
				                <label for="description" class="col-form-label">Description:</label>
				                <textarea class="form-control" name="description" id="description" v-model="description"></textarea>
				                <span class="text-danger" v-if="errors.description" v-text="errors.description[0]"></span>
				                
				            </div>

				            <div class="form-group">
				                <label for="priority" class="col-form-label">Priority Level:</label>
				                <select class="form-control" id="priority" v-model="priority">
				                  <option value="">Select Level</option>
				                  <option value="3">Low Priority</option>
				                  <option value="2">Medium Priority</option>
				                  <option value="1">High Priority</option>
				                </select>
				                <span class="text-danger" v-if="errors.priority" v-text="errors.priority[0]"></span>
				            </div>

				            <div class="form-group">
				            	<button type="submit" class="btn btn-primary btn-sm pull-right ml-2" >Save</button>
				            	<router-link to="/" class="btn btn-secondary btn-sm pull-right">Cancel</router-link>
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
			return{
					title: '',
					description: '',
					priority: '',
					errors: {}
			}

		},
		methods: {
			
			onSubmit() {
				axios.post('/tasks', this.$data)
					.then(this.onSuccess)
					.catch((error)=> this.errors = error.response.data.errors)
			},

			onSuccess(response) {
				window.location = response.data.redirect;
				this.$toasted.show('Task Created!',{ 
					 theme: "bubble", 
					 position: "top-right", 
					 duration : 5000
				})
			}
		}
	}
</script>
