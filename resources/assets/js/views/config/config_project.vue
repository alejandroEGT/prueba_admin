<template>
	<div>
		<h3>configuracion para {{ proyecto.nombre }}</h3>

		 <el-menu :default-active="activeIndex" class="el-menu-demo" mode="horizontal" :router="true">
          <el-menu-item index="1" :route="{path:'/config/'+$route.params.id+'/perfil'}">Perfil</el-menu-item>
          <el-menu-item index="2" :route="{path:'/config/'+$route.params.id+'/colaboradores'}">Colaboradores</el-menu-item>
        </el-menu> 


        <router-view></router-view>
	</div>
</template>


<script type="text/javascript">
	
	import { getProyecto} from '../../endpoints';

	export default{
		data(){
			return{
				proyecto:{},
				activeIndex: '1',
			}
		},
		created(){
			this.get_Proyecto();
		},
		methods:{
			get_Proyecto(){
				getProyecto(this.$route.params.id).then((response)=>{
		             this.proyecto = response.data;
		              console.log(response.data);
		        }).catch((error)=>{

		        });
			}
		}
	}

</script>