<template>
    <div>
        <div class="content">
            <div class="container-fluid">
                <h1>This is vuex controller Component</h1>
                <h4> Current State of Counter is  {{ counter }}</h4>
                <div class="card">
                    <div class="card-body">
                        
                        <div>
                            <compA> </compA>
                        </div>
                        <div>
                            <compB> </compB>
                        </div>
                        <div>
                            <compC> </compC>
                        </div>
                        <button class="btn btn-info" type="info" @click="changeCounter">Change Counter</button>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</template>

<script>
    import compA from './CompA'
    import compB from './CompB'
    import compC from './CompC'
    import {mapGetters, mapActions} from 'vuex'

    export default {
        data(){
            return {
                localVar : 'ETC value'
            }
        },
        computed:{
            ...mapGetters({
                'counter' : 'getCounter'
            })
        },
        methods:{
            // ...mapActions([
            //     'changeCounterAction'
            //     ]),
            changeCounter(){
                // this.$store.commit('changeTheCounter',13)
                this.$store.dispatch('changeCounterAction',12)
            },
            checkingWatchMethod(){
                console.log('checkingWatch Run methods')
            },
        },
        created(){
            console.log(this.$store);
        },
        components : {
            compA,
            compB,
            compC,
        },
        mounted() {
            console.log('vuex controller  Component mounted.')
        },
        watch: {
            counter(value){
                console.log('checkin watch counter variable ', value)
                this.checkingWatchMethod()
                console.log('localVar : ', this.localVar)
            }
        }
    }
</script>
