<template>
    <div class="card border-info mb-4">
        <div class="card-header">
            <input type="checkbox" class="hovered check-cha" :id="per.id" v-model="checker" @change="checkModule">
            <label :for="per.id" class="p-2 title-card hovered">{{per.name}}</label>
        </div>
        <div class="card-body text-info">
            <div class="row">
                <div class="col-md-6" v-for="percon in per.chucnangcon" :key="percon.id">
                    <input type="checkbox" :value="percon.id" :id="percon.id" class="hovered check-con">
                    <label :for="percon.id" class="card-text p-2 hovered">{{ percon.name }}</label>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data(){
        return{
            checker:false,
        }
    },
    props:['per'],
    computed:{
        getper(){
            return this.per;
        }
    },
    methods:{
        checkModule(){
            var checkChaById= document.getElementById(this.per.id);
            var checkCon = checkChaById.parentNode.parentNode.getElementsByClassName('check-con');
            for(var i = 0; i<checkCon.length; i++){
                checkCon[i].checked = this.checker;
            }
        }
    }
}
</script>

<style>

</style>