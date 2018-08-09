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

					<hr>
					
					<span v-if="Object.keys(newSubTask).length > 0">
						<label for="" class="text-muted">Sub-Task Details:</label>
						<div class="form-group">
	       				<label for="title" class="col-form-label"><b>Sub Title:</b></label> {{newSubTask.title}}
		   			 	</div>

			            <div class="form-group">
			                <label for="description" class="col-form-label"><b>Sub Description:</b></label>  {{newSubTask.description}}
			            </div>

			             <div class="form-group">
			                <i class="btn btn-danger btn-sm fa fa-trash-o pull-right" aria-hidden="true" @click="del(newSubTask.id)"></i>
			                <router-link :to="{name: 'editsubtask', params: {id: task.id}}" class="btn btn-success btn-sm pull-right fa fa-edit"></router-link>
			            </div>

					</span>
					<span v-else="Object.keys(newSubTask).length === 0" >
                        <div v-for="(row, index) in rows" id="subTaskForm">
                        
							<form method="POST" @submit.prevent="addSubTask">
		                    

		                    <input type="text" class="form-control" v-model="subtask.title" placeholder="Sub Task Title" >
		                     <span class="text-danger" v-if="errors.title" v-text="errors.title[0]"></span><br>

		                    <textarea class="form-control" id="description" v-model="subtask.description" placeholder="Sub Task Description" ></textarea>
		                    <span class="text-danger" v-if="errors.description" v-text="errors.description[0]"></span><br>

		                     <a v-on:click="removeElement(index);" style="cursor: pointer" class="btn btn-outline btn-sm fa fa-times-circle-o pull-right"> Remove</a>
		                     <button type="submit" class="btn btn-primary btn-sm pull-right" >Save</button>

		                    <input type="hidden" v-model="task_id=task.id">
		                </form>
              			</div>
					</span>

					<router-link to="/" class="btn btn-secondary btn-sm">Back To Tasks</router-link>
                    <span v-if="Object.keys(newSubTask).length === 0">
                        <button class="btn btn-success btn-sm" id="subtaskform" @click="addRow" >Add Sub Task</button>
                    </span>

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
				task: {},
				subtask: {
					title: '',
					description: ''
				},
				rows: [],
				newSubTask: {},
				errors: {}
			}
		},

		mounted() {

			axios.get('/tasks/' + this.$route.params.id)
				.then(response => this.task = response.data)

			axios.post('/getSubTask/' + this.$route.params.id)
				.then(response => this.newSubTask = response.data)	
		},

		methods: {

			addSubTask() {
		        axios.post(`/storeSubTask/` + this.task.id,{
		        	task_id: this.task.id,
			        title: this.subtask.title,
			        description: this.subtask.description,
			        
		        }).then(response => this.newSubTask = response.data)
		        .then((response) => this.$toasted.show('Sub-Task Created!',{ 
					 theme: "bubble", 
					 position: "top-right", 
					 duration : 3000
				}))
		        
                .catch((error)=> this.errors = error.response.data.errors)
                
		      },

		    del(id){
	          if (confirm("Are you sure?")){
	            axios.delete(`/deleteSubTask/${id}`)
	            
	            .then((response) => this.$toasted.show('Sub-Task Deleted!',{ 
					 theme: "bubble", 
					 position: "top-right", 
					 duration : 3000
				}))
				this.reload()
	            .catch((error) => this.errors = error.response.data.errors)
	          }
          
        	},

			addRow() {
	        var elem = document.createElement('tr');
	        this.rows.push({
	          title: '',
	          description: ''
	        })
	        this.hideButton()
	      },

	      removeElement(index) {
	        this.rows.splice(index, 1)
	        $("#subtaskform").show()
	      },

	      hideButton() {
	      	$("#subtaskform").hide()
	      },

	      reload() {
	      	location.reload();
	      }
		}
	}
</script>