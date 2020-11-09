import Vue from 'vue'
import Router from 'vue-router'

Vue.use(Router)

import NewComponent from './components/NewComponent'
import ExampleComponent from './components/ExampleComponent'
import Hooks from './components/Hooks'


import home from './components/blog/Home'
import tags from './components/blog/Tags'



const routes= [
	 
	// project routes
	{
		path: '/',
		component: home
	},
	{
		path: '/tags',
		component: tags
	},



	// Learning Routes
	{
		path: '/new',
		component:NewComponent
	},
	{
		path: '/example',
		component:ExampleComponent
	},
	{
		path: '/hooks',
		component:Hooks
	}
]
export default new Router({
	mode: 'history',
	routes
})
