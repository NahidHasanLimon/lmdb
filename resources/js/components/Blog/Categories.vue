<template>
	<div>
		<div class="content">
			<div class="container">
					
				<!--~~~~~~~ TABLE ONE ~~~~~~~~~-->
				<div class="_1adminOverveiw_table_recent _box_shadow _border_radious _mar_b30 _p20">
					<p class="_title0">categories 
						<Button @click="addModal=true"><Icon type="md-add" />Add Category</Button></p>

					<div class="_overflow _table_div">
						<table class="_table">
								<!-- TABLE TITLE -->
							<tr>
								<th>ID</th>
								<th>Name</th>
								<th>Icon</th>
								<th>Created At</th>
								<th>Action</th>
							</tr>
								<!-- TABLE TITLE -->


								<!-- ITEMS -->
							<tr v-for="(category, i) in categories" :key="i" v-if="categories.length">
								<td>{{category.id}}</td>
								<td>{{category.name}}</td>
								<td class="table_image"><img :src="category.icon"></td>
								<td>{{category.created_at}}</td>
								<td>
									
									<Button  class="_btn _action_btn edit_btn1" type="info" @click="editModalData(category,i)">Edit</Button >
									<Button  class="_btn _action_btn make_btn1" type="error" 
									@click="deleteMethod(category,i)" :loading="isDeleting">Delete</Button >
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
					        title="Add Category"
					        :mask-closable="false"
					        :closable="false"
					        >
					        <Input v-model="data.name" class="mb-3" placeholder="Enter A Name" style="width: 300px" />
					        <Upload
					         ref="upload"
						        type="drag"
				        		action="http://localhost:8000/api/blog/category/icon/upload"
						         :format="['jpg','jpeg','png']"
					        	 :max-size="2048"
					        	 :on-format-error="handleFormatError"
					        	 :on-exceeded-size="handleMaxSize"
					        	 :on-success="handleSuccess"
					        	 :show-upload-list="true"
						        >
									<div style="padding: 20px 5px;">
						            <Icon type="ios-cloud-upload" size="52" style="color: #3399ff"></Icon>
						            <p>Click or drag files here to upload</p>
						        </div>
						    </Upload>
						    <div class="demo-upload-list" v-if="data.iconName">
						    		<img :src="data.iconName">
							       <div class="demo-upload-list-cover">
							       	<Icon type="ios-trash-outline" @click="deleteImageFromServer()"></Icon>
							       </div>
							   </div>
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
					        title="Update Category"
					        :mask-closable="false"
					        :closable="false"
					        >
					           <Input v-model="editData.name" class="mb-3" placeholder="Enter A Name" style="width: 300px" />
					           <div class="space"></div>
					        <Upload v-show="isIconNew"
					         ref="upload"
						        type="drag"
				        		action="http://localhost:8000/api/blog/category/icon/upload"
						         :format="['jpg','jpeg','png']"
					        	 :max-size="2048"
					        	 :on-format-error="handleFormatError"
					        	 :on-exceeded-size="handleMaxSize"
					        	 :on-success="handleSuccess"
					        	 :show-upload-list="true"
						        >
									<div style="padding: 20px 5px;">
						            <Icon type="ios-cloud-upload" size="52" style="color: #3399ff"></Icon>
						            <p>Click or drag files here to upload</p>
						        </div>
						    </Upload>
						    <div class="demo-upload-list" v-if="editData.iconName">
						    		<img :src="editData.iconName">
							       <div class="demo-upload-list-cover">
							       	<Icon type="ios-trash-outline" @click="deleteImageFromServer(isAdd=false)"></Icon>
							       </div>
							   </div>
					        <div slot="footer">
					        	<Button type="default" @click="closeEditModal">Close</Button >
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
					name: '',
					iconName: '',
				},
				addModal : false,
				editModal : false,
				isAdding : false,
				isDeleting : false,
				isUpdating : false,
				index: -1,
				categories: [],
				editData:{
					name: '',
					iconName: '',
				},
				isIconNew: false,
			}
			// end of return
		},
		methods: {
			async add(){
				if (this.data.name.trim()=='') {
					return this.error("Category Name is required")
				}
				const res = await this.callApi('post','http://localhost:8000/api/blog/category/store',this.data);
				console.log(res);
				if (res) {
					if (res.status==201) {
					this.success("Saved successfully!")
					this.addModal=false
					this.data.name = ''
					this.data.iconName = ''
					this.categories.unshift(res.data.category)
				}
				else{
					this.error(res.data)
				}
				}
			},
			editModalData(category,index){
				console.log(category);
				let obj = {
					id: category.id,
					name: category.name,
					iconName: category.icon
				}
				this.editData =obj
				this.editModal=true;
				this.index = index;
			},
			async updateMethod(){
				if (this.editData.name.trim()=='') {
					return this.error("Name is required")
				}if (this.editData.iconName.trim()=='') {
					return this.error("Icon is required")
				}
				const res = await this.callApi('post','http://localhost:8000/api/blog/category/update',this.editData);
				console.log(res);
				if (res.status==201) {
					this.success("Update successfully!")
					this.editModal=false
					this.isIconNew = false
					this.categories[this.index]=res.data.category
				}
				else{
					this.error(res.data)
				}
			},
			async deleteMethod(category,index){
				this.isDeleting =true;
				if (category.id=='') {
					return this.error("ID Not Found")
				}
				const res = await this.callApi('post','http://localhost:8000/api/blog/category/destroy',category);
				this.isDeleting=false;
				if (res.status==200) {
					this.categories.splice(index,1);
					this.success("Category has been deleted successfully!")
				}
				else{
					this.error(res.data)
				}
			},
			// file handling methods
			handleRemove (file) {
				// if(!confirm("Do you really want to delete?")){return false}
                // this.deleteImageFromServer();
            },
			handleSuccess (res, file) {
				console.log(res);	
				if (this.isIconNew) {
					this.editData.iconName = res;
				}else{
					this.data.iconName = res;			
				}
				
            },
            handleFormatError (file) {
                this.$Notice.warning({
                    title: 'The file format is incorrect',
                    desc: 'File format of ' + file.name + ' is incorrect, please select jpg or png.'
                });
            },
            handleMaxSize (file) {
                this.$Notice.warning({
                    title: 'Exceeding file size limit',
                    desc: 'File  ' + file.name + ' is too large, no more than 2M.'
                });
            },

            // end of file handling methods
            async deleteImageFromServer(isAdd=true){
            	if(!confirm("Do you really want to delete?")){return false}
            		let tempIconName= ''
            		if (!isAdd) {
            			this.isIconNew=true
            			 tempIconName= this.editData.iconName
			    		this.editData.iconName= ''
			    		this.$refs.upload.clearFiles()
            		}else{
            			 tempIconName= this.data.iconName
			    		this.data.iconName= ''
			    		this.$refs.upload.clearFiles()
            		}
        		const res = await this.callApi('post','http://localhost:8000/api/blog/category/icon/delete',{icon: tempIconName})
				if (res.status!=200) {
					this.data.iconName=tempIconName
					this.error(res.data)
				}else{
				this.success("Icon has been deleted successfully!")
				}
            },
            closeEditModal(){
					this.isIconNew=false
					this.editModal = false
			},
		},
		
		async created (){
			const res = await this.callApi('get','http://localhost:8000/api/blog/category/');
			// console.log(res);
			if (res.status==200) {
				// alert(res.data);
				this.categories= res.data
			}else{
				console.log(res);
			}
		}
	}
</script>
<style scoped>
	.demo-upload-list{
        display: inline-block;
        width: 80px;
        height: 80px;
        text-align: center;
        line-height: 80px;
        border: 1px solid transparent;
        border-radius: 4px;
        overflow: hidden;
        background: #fff;
        position: relative;
        box-shadow: 0 1px 1px rgba(0,0,0,.2);
        margin-right: 4px;
    }
    .demo-upload-list img{
        width: 100%;
        height: 100%;
    }
    .demo-upload-list-cover{
        display: none;
        position: absolute;
        top: 0;
        bottom: 0;
        left: 0;
        right: 0;
        background: rgba(0,0,0,.6);
    }
    .demo-upload-list:hover .demo-upload-list-cover{
        display: block;
    }
    .demo-upload-list-cover i{
        color: #fff;
        font-size: 20px;
        cursor: pointer;
        margin: 0 2px;
    }
    .table_image{
    	width: 35px;
    	height: 35px;
    }
</style>




			