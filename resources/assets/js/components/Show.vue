<template>
	<div class="container">
		<div class="row justify-content-center">
	      <div class="col-md-8">
			<div class="card-header">
				{{task.title}}'s Details
				 <router-link :to="{name: 'edit'}" class="btn btn-success btn-sm pull-right fa fa-edit"> Edit Task</router-link>
			</div>
			<div class="card">
				<div class="card-body">

					<div class="form-group">
	       				<label for="title" class="col-form-label"><b>Title:</b></label> {{task.title}}
	   			 	</div>

		            <div class="form-group">
		                <label for="description" class="col-form-label"><b>Description:</b></label>  {{task.description}}
		            </div>

		            <div class="form-group">
		                <label for="priority" class="col-form-label"><b>Priority Level:</b></label>  
		                <span v-if="task.priority == 1">High Priority</span>
		                <span v-else-if="task.priority == 2">Medium Priority</span>
		                <span v-else="task.priority == 3">Low Priority</span>
		            </div>

		            <div class="form-group">
		                <label for="completed" class="col-form-label"><b>Completed:</b></label>
		                <span v-if="task.completed == 1">Completed</span>
                		<span v-else="task.completed == 0">Not Completed</span> 
		    		</div>

					

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
				task: {}
			}
		},

		mounted() {

			axios.get('/tasks/' + this.$route.params.id)
				.then(response => this.task = response.data)

		},

	}
</script>