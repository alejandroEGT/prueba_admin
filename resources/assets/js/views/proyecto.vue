<template>

  <div>
  
  <el-row>
    <el-col :span="1">
        <span class="el-icon-fa fa-desktop fa-x" ></span>
    </el-col>
    <el-col :span="10">
        <label>{{ proyecto.nombre }}</label>
    </el-col>
    <el-col :offset="9" :span="2">
      <el-button icon="fas fa-cog" @click="redirect($route.params.id)" v-model="btn_conf" >{{ btn_conf }}</el-button>

    </el-col>
  </el-row>

  <!--<el-tabs v-model="activeName" @tab-click="change">
      <el-tab-pane name="primero" >
             <span @click="handleClick('defaultview','primero')"  slot="label"><i class="el-icon-date"></i> Chat</span>
          
      </el-tab-pane>

      <el-tab-pane name="segundo" >
            <span  @click="handleClick('Repositorio','segundo')" slot="label"><i class="el-icon-date"></i> Repositorios</span>
      </el-tab-pane>

      <el-tab-pane>
         <span slot="label" ><i class="el-icon-date"></i> Minutas</span>
      </el-tab-pane>

      <el-tab-pane>
        <span slot="label"><i class="el-icon-date"></i> Requerimientos</span>
      </el-tab-pane>

      <el-tab-pane>
        <span slot="label"><i class="el-icon-date"></i> Encuestas</span>
      </el-tab-pane>

      <el-tab-pane>
        <span slot="label"><i class="el-icon-date"></i> Wiki</span>
      </el-tab-pane>

      <el-tab-pane>
        <span slot="label"><i class="el-icon-date"></i> Notificaciones</span>
      </el-tab-pane>

  </el-tabs>-->
  



  <el-menu class="mi-nav"  :router="true"  mode="horizontal" >
        <template v-for="rule in rutaMenu_items">
            <el-menu-item class="first-letter"  :index="'/panel/proyecto/'+$route.params.id +'/'+rule.name" >{{ rule.name  }}</el-menu-item>
        </template>
</el-menu>


    <!--<div v-for="rule in $router.options.routes">
      <h1>{{ rule }}</h1>
    </div>-->
      

      <router-view></router-view>
  </div>
</template>

<script>
  import { getProyecto} from '../endpoints';
export default {
    data() {
      return {
        btn_conf:'configuración',
        proyecto:{},
      };
    },


    created() {    
      this.rutaMenu_items = this.$router.options.routes[3].children[2].children;
      this.get_proyecto();
      //console.log(this.$router.options);
    },
    methods: {

      get_proyecto(){

          getProyecto(this.$route.params.id).then((response)=>{
              this.proyecto = response.data;
              console.log(response.data);
          }).catch((error)=>{

          });
      },
      redirect(id){
        //alert(id);
        this.$router.push({ path: '/config/'+id })
      }
    
    }
  };


</script>

<style type="text/css">
  .mi-nav{
    background: white;
  }
  .first-letter {
    text-transform:capitalize;
}
</style>


