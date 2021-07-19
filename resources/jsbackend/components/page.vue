<template>
	<nav aria-label="Page navigation example">
		<ul class="pagination justify-content-end">
			<li class="page-item" @click.prevent="prev()"><a class="page-link" href="#">Previous</a></li>
			<li class="page-item" :class="{'active': currentPage==page}" @click.prevent="setPage(page)" v-for="page in page_number" :key="page"><a class="page-link" href="#">{{ page }}</a></li>
			<li class="page-item" @click.prevent="next()"><a class="page-link" href="#">Next</a></li>
		</ul>
	</nav>
</template>

<script>
export default {
    data(){
    	return{
			currentPage:1,
		}
    },
    props:['page_number'],
	methods:{
		setPage(newPage){
			this.currentPage = newPage;
			this.$emit('getPage', this.currentPage);
		},
		prev(){
			if(this.currentPage > 1){
				this.currentPage--;
				this.$emit('getPage', this.currentPage);
			}
		},
		next(){
			if(this.currentPage < this.page_number){
				this.currentPage++;
				this.$emit('getPage', this.currentPage);
			}
		}
	}
}
</script>

<style>

</style>