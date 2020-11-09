<template>
	<div>
		<div class="card">
			<div class="card-header text-center">
				<h1 ref="testRef">Hooks Tutorial</h1>
			</div>
			<div class="card-body">
				<h1>My Name is: {{name}}</h1>
				<div class="container">
					<h2>The Number is : {{counter}}</h2>
					<button class="btn"  @click="updateCounter(1)">+</button>
					<button  class="btn" @click="updateCounter(-1)">-</button>
				</div>
				<!-- end of counter -->
				<div class="container">
					<h6>Blog Display</h6>
					<div class="card" v-for="(blog, i) in blogs" :key="i" v-if="blogs.length">
						<div class="card-header text-uppercase text-center">
							<h6>{{blog.title}}</h6>
						</div>
						<div class="card-body">
							<p>
								{{blog.post}}
							</p>
						</div>
					</div>
					
				</div>
				<div class="container">
					<div class="card">
						<div class="card-header text-center">
							<h1>Learning Show / Hide Function </h1>
						</div>
						<div class="card-body">
							<span v-if ="showItem">Show this item if it is true</span>
							<span v-else>Show this item if it is false</span>
							<button class="btn btn-secondary" @click="toggleShowItem()">Toggling</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</template>
<script>
export default{
	data(){
		return{
			name: "Limon",
			counter: 0,
			blogs: [
			
			],
			// end of blogs array
			showItem: true,
		}
		// end of return
	},
	// methods
	methods:{
		updateCounter(number){
			this.counter = this.counter+number;
		},
		toggleShowItem(){
			this.showItem = !this.showItem;
		}
	},
	// hooks
	beforeCreate(){	
		console.log("Execute From before create ",this.name);
	},

		// call mostly initial data Data and other function available but not html because its initiated before HTML Rendering. mostly used for call API
	created(){
		console.log("Execute from created hooks",this.name);
		this.counter=120;
		let blogs = [
				{
					title: "First Title",
					post: "First Blog Post",
					id: 1
				},
				{
					title: "Second Title",
					post: "Second Blog Post",
					id: 2
				},
				{
					title: "Third Title",
					post: "Third Blog Post",
					id: 3
				},
				{
					title: "Fourth Title",
					post: "Fourth Blog Post",
					id: 4
				},
				{
					title: "Fifth Title",
					post: "Fifth Blog Post",
					id: 5
				}
			
		];
		this.blogs= blogs;
	}, 
	//From mouted we can access html element , local storage ..... Mounted initiated after HTML Redered
	mounted(){
		console.log("Execute from mounted hooks",this.name);
		console.log(this.$refs.testRef);
	},
	beforeMount(){
		console.log("Execute from beforeMount hooks",this.name);
	}
}
</script>