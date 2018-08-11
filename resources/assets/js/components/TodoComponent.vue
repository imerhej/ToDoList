<template>
	<div class="container">
		<div class="row justify-content-center">
    		<div class="col-md-10">
    			<div class="card">
		          <div class="card-header">
		          ToDo List
		             <router-link :to="{name: 'create'}" class="btn btn-success btn-sm pull-right fa fa-plus"> New Task</router-link>
		          </div>

		          <div class="card-body">
		            <table class="table">
			          <thead>
			            <tr>
			              <th>Title</th>
			              <th>Description</th>
			              <th>Priority</th>
			              <th>Completed</th>
			              <!-- <th></th> -->
			            </tr>
			          </thead>
			          <tbody>
			            <tr v-for="task,index in tasks">
			                <td id="title">{{task.title}}</td>
			                <td>{{(task.description).substring(0, 40)+"..."}}</td>
			                <td v-if="task.priority == 1">
			                	High Priority
			                </td>
			                <td v-else-if="task.priority == 2">
			                	Medium Priority
			                </td>
			                <td v-else="task.priority == 3">
			                	Low Priority
			                </td>
			                <td>
			                     <input type="checkbox" name="completed" id="completed" value="1" v-model="task.completed" @click="updateCompleted(index, task.id)" >
			                </td>
			                <td>
			                	<router-link :to="{name: 'show', params: {id: task.id}}" class="btn btn-sm btn-success fa fa-eye"></router-link>
			                	<router-link :to="{name: 'edit', params: {id: task.id}}" class="btn btn-sm btn-primary fa fa-edit"></router-link>

			                  <i class="btn btn-danger btn-sm fa fa-trash-o" aria-hidden="true" @click="del(index, task.id)"></i>
			                </td>
			        	</tr>
			          </tbody>
			    	</table>
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
				tasks: {},
				completed: true,
				task: ''
			}
		},

		mounted() {
			this.getTasks();
		},
		methods: {
			
			openShow(index) {
				this.task = this.tasks[index]
				window.location = 'tasks/'+ this.task.id;
			},

			getTasks() {
	            axios.post('/getTasks')
		            .then((response) => this.tasks = response.data)
		            .catch((error) => this.errors = error.response.data.errors)
        	},

        	updateCompleted(key,id) {
         		axios.post(`/tasks/${id}`)
         		.then((response) => {
         			this.$toasted.show('Task updated!',{ 
					 theme: "bubble", 
					 position: "top-right", 
					 duration : 3000
				})
         			this.task = response.data
         		})
		        .catch((error) => this.errors = error.response.data.errors)
        	},

        	del(key, id){
	          if (confirm("Are you sure?")){
	            axios.delete(`/tasks/${id}`)
	            .then((response) => this.tasks.splice(key,1))
	            .then((response) => this.$toasted.show('Task Deleted!',{ 
					 theme: "bubble", 
					 position: "top-right", 
					 duration : 3000
				}))
	            .catch((error) => this.errors = error.response.data.errors)
	          }
          
        	},

        	onDeleted() {
        		alert('Task Deleted!');
        	}
		}
	}
</script>