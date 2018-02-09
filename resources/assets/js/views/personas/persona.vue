<template>
	<dir>
		<h3>header</h3>
		 <el-menu class="mi-nav"  :router="true"  mode="horizontal" >
        <template v-for="rule in rutaMenu_items">
            <el-menu-item class="first-letter"  :index="'/panel/persona/'+$route.params.id +'/'+rule.name" >{{ rule.name  }}</el-menu-item>
        </template>
</el-menu>


    <!--<div v-for="rule in $router.options.routes">
      <h1>{{ rule }}</h1>
    </div>-->
      

      <router-view></router-view>
	</dir>
</template>

<script type="text/javascript">
	export default {

		 created() {    
		      this.rutaMenu_items = this.$router.options.routes[3].children[2].children;
		      //console.log(this.$router.options);
		    }
	}
</script>