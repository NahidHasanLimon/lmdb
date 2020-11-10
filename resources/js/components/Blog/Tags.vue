<template>
	<div>
		<div class="content">
			<div class="container">
					
				<!--~~~~~~~ TABLE ONE ~~~~~~~~~-->
				<div class="_1adminOverveiw_table_recent _box_shadow _border_radious _mar_b30 _p20">
					<p class="_title0">Tags 
						<Button @click="addModal=true"><Icon type="md-add" />Add Tag</Button></p>

					<div class="_overflow _table_div">
						<table class="_table">
								<!-- TABLE TITLE -->
							<tr>
								<th>ID</th>
								<th>Tag</th>
								<th>Created At</th>
								<th>Action</th>
							</tr>
								<!-- TABLE TITLE -->


								<!-- ITEMS -->
							<tr v-for="(tag, i) in tags" :key="i" v-if="tags.length">
								<td>{{tag.id}}</td>
								<td class="_table_name">{{tag.name}}</td>
								<td>{{tag.created_at}}</td>
								<td>
									
									<Button  class="_btn _action_btn edit_btn1" type="info" @click="editModalData(tag,i)">Edit</Button >
									<Button  class="_btn _action_btn make_btn1" type="error" 
									@click="deleteMethod(tag,i)" :loading="isDeleting">Delete</Button >
								</td>
							</tr>
								<!-- ITEMS -->


						</table>
					</div>
				</div>
				 <!-- <Page :total="100" /> -->
				 <!-- start of add modal -->
						  <Modal
					        v-model="addModal"
					        title="Add Tag"
					        :mask-closable="false"
					        :closable="false"
					        >
					        <Input v-model="data.name" placeholder="Enter A Name" style="width: 300px" />
					        <div slot="footer">
					        	<Button type="default" @click="addModal=false">Close</Button >
					        	<Button type="primary" @click="add" 
					        	:disabled="isAdding" :loading="isAdding">{{isAdding ? 'Adding..' : 'Add'}}</Button >
					        </div>
					    </Modal>
				 <!-- end of add modal -->
				 <!-- start of edit modal -->
						  <Modal
					        v-model="editModal"
					        title="Update Tag"
					        :mask-closable="false"
					        :closable="false"
					        >
					        <Input v-model="editData.name" placeholder="Enter A Name" style="width: 300px" />
					        <div slot="footer">
					        	<Button type="default" @click="editModal=false">Close</Button >
					        	<Button type="primary" @click="updateMethod" 
					        	:disabled="isUpdating" :loading="isUpdating">{{isUpdating ? 'updating..' : 'Update'}}</Button >
					        </div>
					    </Modal>
				 <!-- end of edit modal -->
			</div>
		</div>
	</div>
</template>

<script type="text/javascript">
	export default {
		data(){
			return {
				data: {
					name: ''
				},
				addModal : false,
				editModal : false,
				isAdding : false,
				isDeleting : false,
				isUpdating : false,
				index: -1,
				tags: [],
				editData:{
					name: ''
				}
			}
		},
		methods: {
			async add(){
				if (this.data.name.trim()=='') {
					return this.error("Tag Name is required")
				}
				const res = await this.callApi('post','http://localhost:8000/api/blog/tag/store',this.data);
				console.log(res);
				if (res.status==201) {
					this.success("Saved successfully!")
					// this.addModal=false
					this.tags.unshift(res.data.tag)
				}
				else{
					this.error(res.data)
				}
			},
			editModalData(tag,index){
				// this.editData=tag;
				let obj = {
					id: tag.id,
					name: tag.name
				}
				this.editData =obj
				this.editModal=true;
				this.index = index;
			},
			async updateMethod(){
				if (this.editData.name.trim()=='') {
					return this.error("Tag Name is required")
				}
				const res = await this.callApi('post','http://localhost:8000/api/blog/tag/update',this.editData);
				console.log(res);
				if (res.status==201) {
					this.success("Update successfully!")
					this.editModal=false
					this.tags[this.index]=res.data.tag
				}
				else{
					this.error(res.data)
				}
			},
			async deleteMethod(tag,index){
				this.isDeleting =true;
				if (tag.id=='') {
					return this.error("ID Not Found")
				}
				const res = await this.callApi('post','http://localhost:8000/api/blog/tag/destroy',tag);
				this.isDeleting=false;
				if (res.status==200) {
					this.tags.splice(index,1);
					this.success("Tag has been deleted successfully!")
				}
				else{
					this.error(res.data)
				}
			}
		},
		async created (){
			const res = await this.callApi('get','http://localhost:8000/api/blog/tag/');
			// console.log(res);
			if (res.status==200) {
				// alert(res.data);
				this.tags= res.data
			}else{
				console.log(res);
			}
		}
	}
</script>




			