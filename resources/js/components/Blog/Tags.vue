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
									
									<Button  class="_btn _action_btn edit_btn1" type="info">Edit</Button >
									<Button  class="_btn _action_btn make_btn1" type="error">Delete</Button >
								</td>
							</tr>
								<!-- ITEMS -->


						</table>
					</div>
				</div>
				 <!-- <Page :total="100" /> -->
				 <!-- start of modal -->
						  <Modal
					        v-model="addModal"
					        title="Add Tag"
					        :mask-closable="false"
					        :closable="false"
					        >
					        <Input v-model="data.name" placeholder="Enter A Name" style="width: 300px" />
					        <p>Content of dialog</p>
					        <p>Content of dialog</p>
					        <div slot="footer">
					        	<Button type="default" @click="addModal=false">Close</Button >
					        	<Button type="primary" @click="addTag" 
					        	:disabled="isAdding" :loading="isAdding">{{isAdding ? 'Adding..' : 'Add'}}</Button >
					        </div>
					    </Modal>
				 <!-- end of modal -->
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
				isAdding : false,
				tags: [],
			}
		},
		methods: {
			async addTag(){
				if (this.data.name.trim()=='') {
					this.error("Tag Name is required")
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




			