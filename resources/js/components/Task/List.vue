<template>
    <div>
    <div class="row">
        <h4>Filter by : </h4>
        <div class="col">
            <div class="form-group">
                <label>Status</label>
                <select class="form-select" aria-label="Default select example" v-model="filterStatus">
                    <option value="All">All</option>
                    <option value="done">done</option>
                    <option value="new">new</option>
                    <option value="panding">panding</option>
                </select>
            </div>
        </div>
        <div class="col">
            <div class="form-group">
                <label>Destination date</label>
                <select class="form-select" aria-label="Default select example" v-model="filterDate">
                    <option value="All">All</option>
                    <option v-if="task.destination_date"  v-for="task in tasks" :key="task.id" :value="task.destination_date">{{ task.destination_date }}</option>
                </select>
            </div>
        </div>
        <div class="col-12" style="margin-top:15px">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col"><h4>Task</h4></div>
                        <div class="col"> <router-link style="float: right" :to='{name:"taskAdd"}' class="btn btn-primary">Create</router-link></div>

                    </div>
                </div>
                <div class="card-body" v-if="tasks.length > 0">
                    <vue-good-table
                        :columns="columns"
                        :rows="allData">
                        <template slot="table-row" slot-scope="props">
                            <span v-if="props.column.field == 'actions'">
                                <span>
                                    <router-link :to='{name:"taskEdit",params:{id:props.row.id}}' class="btn btn-success">Edit</router-link>
                                    <button type="button" @click="deleteCategory(props.row.id)" class="btn btn-danger">Delete</button></span>
                            </span>
                            <span v-else>
                                {{props.formattedRow[props.column.field]}}
                            </span>
                        </template>
                    </vue-good-table>
                </div>
            </div>
        </div>
    </div>
    </div>
</template>

<script>
export default {
    name: "List",
    data(){
        return { columns: [
                {
                    label: 'Id',
                    field: 'id',
                },
                {
                    label: 'Title',
                    field: 'title',
                },
                {
                    label: 'Status',
                    field: 'status',
                },
                {
                    label: 'Description',
                    field: 'description',
                },
                {
                    label: 'Destination date',
                    field: 'destination_date',
                    type: 'date',
                    dateInputFormat: 'yyyy-MM-dd',
                    dateOutputFormat: 'dd-MM-yyyy',
                },
                {
                    label: 'Actions',
                    field: 'actions',
                },
            ],
            tasks:[],
            filterStatus:"",
            filterDate:"",
        }
    },
    mounted(){
        this.getTasks()
    },
    computed:{
        allData() {
            return this.filterByDate(this.filterByStatus());
        },
    },
    methods:{
         filterByStatus () {
            if (this.filterStatus != "All") {
                let _this = this;
                    if (_this.tasks) {
                        let filter = _this.tasks.filter(function (task) {
                            if (task.status) {
                                return task.status.includes(_this.filterStatus);
                            }
                        });
                        return filter;
                    }
            } else {
                return this.tasks;
            }
        },

         filterByDate (tasks) {
            let _this = this;
            if (tasks) {
                if (this.filterDate != "All") {
                    let filter = tasks.filter(function (task) {
                        if(!filter.includes(_this.filterDate))
                        {
                            return task.destination_date.includes(_this.filterDate);
                        }
                });
                return filter;
            }else{
                    return tasks
                }
            }
        },
        async getTasks(){
            await this.axios.get('/api/task').then(response=>{
                this.tasks = response.data
            }).catch(error=>{
                console.log(error)
                this.tasks = []
            })
        },
        deleteCategory(id){
            if(confirm("Are you sure to delete this task ?")){
                this.axios.delete(`/api/task/${id}`).then(response=>{
                    if(response.data.status !== "success"){
                        alert("The target duration of the task is set to less than six days and therefore cannot be deleted")
                    }
                    this.getTasks()
                }).catch(error=>{
                    console.log(error)
                })
            }
        }
    }
}

</script>

<style scoped>

</style>
