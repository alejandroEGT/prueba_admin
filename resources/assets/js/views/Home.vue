<template>

    <el-row class="container">
        <el-col :span="24" class="header">
            <el-col :span="10" class="logo" :class="collapsed?'logo-collapse-width':'logo-width'">
                {{collapsed?'':sysName}}
            </el-col>
            <el-col :span="10">
                <div class="tools" @click.prevent="collapse">
                    <i class="fa fa-align-justify"></i>
                </div>
            </el-col>
            <el-col :span="4" class="userinfo">
                <el-dropdown trigger="hover">
                    <span class="el-dropdown-link userinfo-inner"><img :src="this.sysUserAvatar" /> {{sysUserName}}</span>
                    <el-dropdown-menu slot="dropdown">
                        <el-dropdown-item>Some action</el-dropdown-item>
                        <el-dropdown-item divided @click.native="logout">Exit</el-dropdown-item>
                    </el-dropdown-menu>
                </el-dropdown>
            </el-col>
        </el-col>
        <el-col :span="24" class="main">
            <aside :class="collapsed?'menu-collapsed':'menu-expanded'">
                <el-row>
                  <el-col :span="24">
                     <el-menu style="background-color:#FDFEFE;">
                          <el-dropdown 
                            style="margin:10px;" size="small"
                          split-button type="default" @click="handleClick" v-loading="loading">
                              {{ nameAuth.name}}
                              <el-dropdown-menu slot="dropdown">
                                <el-dropdown-item v-bind:value="nameAuth.id">{{ nameAuth.name }}</el-dropdown-item>
                                 <el-dropdown-item v-bind:value="7">{{ 'user 2' }}</el-dropdown-item>
                                
                                
                              </el-dropdown-menu>
                            </el-dropdown>
                        
                        <el-collapse v-model="activeNames" @change="handleChange" style="margin:5px;">
                            <el-collapse-item title="Proyectos" name="1" >
                                Proyectos: <el-badge class="mark" :value="3" /> 
                                
                                        <el-tooltip class="item" effect="dark" content="Crear un nuevo proyecto" placement="bottom">
                                            <el-button @click="dialogVisible = true" size="mini" style="margin-left: 35px;" type="primary" icon="fa fa-plus">Nuevo</el-button>
                                        </el-tooltip>
                                        <el-dialog
                                          title="Nuevo proyecto"
                                          :visible.sync="dialogVisible"
                                          width="30%"
                                          :before-close="handleClose">
                                          
                                            
                                            <div style="margin: 20px;"></div>

                                            <el-form :label-position="labelPosition" label-width="100px" :model="proyecto">
                                                

                                                    <el-select v-model="proyecto.id_user" placeholder="Select">
                                                      <el-option
                                                        :key="nameAuth.id"
                                                        :label="nameAuth.name"
                                                        :value="nameAuth.id">
                                                      </el-option>
                                                    </el-select>
                                            
                                              
                                              <el-form-item label="Nombre">
                                                <el-input v-model="proyecto.nombre" style="width:70%" ></el-input>
                                              </el-form-item>

                                              <el-button @click="dialogVisible = false">Cancel</el-button>
                                            <el-button type="primary" @click.submit="submitProyecto">Confirm</el-button>


                                            </el-form>


                                        
                                        </el-dialog>

                                         <el-input
                                            size="small"
                                            placeholder="Please Input"
                                            v-model="input9">
                                          </el-input>
                                    <el-tabs v-model="activeName" @tab-click="handleClick" style="
                                        border-bottom: 1px solid #E5E7E9 ;">
                                        <el-tab-pane label="Todos" name="first">
                                            
                                            <div  style="margin-left:5px ;overflow:scroll;height:100px;">
                                                <li v-for="list in list_proyecto">
                                                    <!--<router-link :to="{ name: 'Proyecto', params:{ id: list.id}  }" append>-->
                                                    <a :href="'/#/panel/proyecto/' + list.id +'/'" >
                                                        <el-button icon="fa fa-desktop" type="text" style="color:black" >{{ list.nombre }}</el-button>
                                                    </a>    
                                                        <!--</router-link>-->
                                                </li>
                                                        
                                            </div>

                                        </el-tab-pane>
                                        <el-tab-pane label="Mios" name="second">Config</el-tab-pane>
                                        
                                      </el-tabs>
                                        <br>
                                      <el-popover
                                      ref="popover4"
                                      placement="right"
                                      width="500"
                                      
                                      trigger="click">
                                     <div >
                                         <h3>Lista de contactos</h3>
                                         <el-tabs type="border-card">
                                              <el-tab-pane style=" height:400px; width:200; overflow: auto;">
                                                <span slot="label"><i class="fa fa-globe"></i> Todos</span>

                                                    <el-row :gutter="10" style="border-bottom: 1px solid #D5D8DC; margin:10px ">
                                                        <el-col :xs="8" :sm="6" :md="4" :lg="3" :xl="1">
                                                            <img class="img-contact" src="http://sm.ign.com/ign_es/screenshot/default/goku-0_19cy.jpg">
                                                        </el-col>
                                                        <el-col :xs="4" :sm="6" :md="8" :lg="9" :xl="11">
                                                            <label class="lbl-non">Aphix</label><br>
                                                            <label >Equipo</label>
                                                        </el-col>      
                                                    </el-row>
                                                    <el-row :gutter="10" style="border-bottom: 1px solid #D5D8DC; margin:10px ">
                                                        <el-col :xs="8" :sm="6" :md="4" :lg="3" :xl="1">
                                                            <img class="img-contact" src="https://qph.ec.quoracdn.net/main-qimg-76b1a9a47d43e3792bd1ae5a9b2394d8">
                                                        </el-col>
                                                        <el-col :xs="4" :sm="6" :md="8" :lg="9" :xl="11">
                                                            <router-link style="text-decoration:none;"  :to="{ name: 'Persona', params: { id: 123 }}" ><label class="lbl-non">Alejandro godoy</label><br>
                                                            <label >Usuario</label></router-link>
                                                        </el-col>      
                                                    </el-row>
                                                     <el-row :gutter="10" style="border-bottom: 1px solid #D5D8DC; margin:10px ">
                                                        <el-col :xs="8" :sm="6" :md="4" :lg="3" :xl="1">
                                                            <img class="img-contact" src="http://sm.ign.com/ign_es/screenshot/default/goku-0_19cy.jpg">
                                                        </el-col>
                                                        <el-col :xs="4" :sm="6" :md="8" :lg="9" :xl="11">
                                                            <label class="lbl-non">Aphix</label><br>
                                                            <label >Equipo</label>
                                                        </el-col>      
                                                    </el-row>
                                                   
                                             
                                              </el-tab-pane>
                                              <el-tab-pane>
                                                <span slot="label"><i class="fa fa-user"></i> Personas</span>
                                                <ul>
                                                    <li>diego</li>
                                                    <li>danilo</li>
                                                </ul>
                                              </el-tab-pane>
                                              <el-tab-pane>
                                                <span slot="label"><i class="fa fa-users"></i> Equipo</span>
                                                <ul>
                                                    <li>Aphix</li>
                                                    <li>Exod</li>
                                                </ul>
                                              </el-tab-pane>
                                              
                                            </el-tabs>
                                     </div>
                                    </el-popover>

                                    <el-button v-popover:popover4 class="btn" icon="fa fa-heart-o">
                                        Contactos (2)
                                    </el-button>
                                
                              </el-collapse-item>

                              <el-collapse-item title="Enlaces" name="3" >
                                      <el-tabs type="border" style="border: 1px solid #E5E7E9 ;">
                                          <el-tab-pane style="margin-left:30px">
                                            <span slot="label"><i class="fa fa-bar-chart"></i> Estadisticas</span>
                                                <div>
                                                <router-link :to="{ path: '/index'}">
                                                <el-button icon="fa fa-angle-right" type="text" @click="dialogVisible = true">Enlace 1</el-button>
                                                </router-link>
                                                </div>
                                                <div>
                                                <router-link :to="{ path: '/index'}">
                                                <el-button icon="fa fa-angle-right" type="text" @click="dialogVisible = true">Enlace 1</el-button>
                                                </router-link>
                                                </div>
                                                <div>
                                                <router-link :to="{ path: '/index'}">
                                                <el-button icon="fa fa-angle-right" type="text" @click="dialogVisible = true">Enlace 1</el-button>
                                                </router-link>
                                                </div>
                                                <div>
                                                <router-link :to="{ path: '/index'}">
                                                <el-button icon="fa fa-angle-right" type="text" @click="dialogVisible = true">Enlace 1</el-button>
                                                </router-link>
                                                </div>
                                          </el-tab-pane>
                                           <el-tab-pane>
                                            <span slot="label"><i class="el-icon-date"></i> Otros</span>
                                            Route
                                          </el-tab-pane>
                                          
                                      </el-tabs>
                                </el-collapse-item>      
  
                        </el-collapse>
                            
                    </el-menu>
                    
                </el-col>
                </el-row>
    
               
                <ul class="el-menu el-menu-vertical-demo collapsed" v-show="collapsed" ref="menuCollapsed">
                    <li v-for="(item,index) in $router.options.routes" v-if="!item.hidden" class="el-submenu item">
                        <template v-if="!item.leaf">
                            <div class="el-submenu__title" style="padding-left: 20px;" @mouseover="showMenu(index,true)" @mouseout="showMenu(index,false)"><i :class="item.iconCls"></i></div>
                            <ul class="el-menu submenu" :class="'submenu-hook-'+index" @mouseover="showMenu(index,true)" @mouseout="showMenu(index,false)">
                                <li v-for="child in item.children" v-if="!child.hidden" class="el-menu-item" style="padding-left: 40px;" :class="$route.path==child.path?'is-active':''" @click="$router.push(child.path)">{{child.name}}</li>
                            </ul>
                        </template>
                        <template v-else>
                            <li class="el-submenu">
                                <div class="el-submenu__title el-menu-item" style="padding-left: 20px;height: 56px;line-height: 56px;padding: 0 20px;" :class="$route.path==item.children[0].path?'is-active':''" @click="$router.push(item.children[0].path)"><i :class="item.iconCls"></i></div>
                            </li>
                        </template>
                    </li>
                </ul>
            </aside>
            <section class="content-container">
                <div class="grid-content bg-purple-light">
                    <el-col :span="24" class="breadcrumb-container">
                        <!--<strong class="title">{{$route.path}}</strong>-->
                        <el-breadcrumb separator="/" class="breadcrumb-inner">
                            <el-breadcrumb-item v-for="item in $route.matched" :key="item.id">
                                {{ item.name }}
                            </el-breadcrumb-item>
                        </el-breadcrumb>
                    </el-col>
                    <el-col :span="24" class="content-wrapper">
                        <transition name="fade" mode="out-in">
                            <router-view :key="$route.path"></router-view>
                        </transition>
                    </el-col>
                </div>
            </section>
        </el-col>
    </el-row>
</template>
<style type="text/css">
    .btn{
        width: 180px;
    }
    .img-contact{
        border-radius: 50%;
        height: 50px;
        width: 50px;
    }
    .lbl-non{
        color: #1F618D;
        text-align: center;
        vertical-align: middle;
        /*line-height: -30px; */
    }
</style>
<script>
    
    import { getUserAuth, submitProyecto, listarproyecto } from '../endpoints';

    export default {
        data() {
            return {
                loading: true,
                sysName:'Estake',
                activeName: 'first',
                activeName2: 'first',
                activeNames: ['1','2','3'],
                collapsed: false,
                dialogVisible: false,
                labelPosition:'right',

                proyecto: {},
                input9:'',
                nameAuth: '',
                sysUserName: this.$auth.user().email,
                sysUserAvatar: this.$auth.user().avatar,
                form: {
                    name: '',
                    region: '',
                    date1: '',
                    date2: '',
                    delivery: false,
                    type: [],
                    resource: '',
                    desc: ''
                },
                list_proyecto:{}
            }
        },
        created(){
            this.getNameUser();
            this.getLista();
             //this.$router.push({name: 'Index'});
        },
        methods: {

            getNameUser() {
                getUserAuth().then((response) =>{
                        console.log(response);
                        this.nameAuth = response.data;
                        this.loading = false;
                }).catch((error) =>{
                        console.log("error");
                });
            },
            getLista(){
               listarproyecto().then((response)=>{
                  this.list_proyecto = response.data;
                  console.log(response.data);
               }).catch((error)=>{
                  this.list_proyecto = "nada para listar";
                  console.log("sin datos");
               });
            },

            handleChange(){

            } , 
            handleClick() {
                console.log('handleopen');
            },
            submitProyecto() {
               // console.log(this.proyecto);/*lorem  djasldjas*/
                submitProyecto(this.proyecto).then((response)=>{
                   
                    this.$message({
                      message: response.data.succsess,
                      type: 'success'
                    });
                    this.proyecto = {};
                    this.getLista();

                }).catch((error)=>{
                   this.$message.error('Error, proyecto no creado');
                });
            },
            handleopen() {
                //console.log('handleopen');
            },
            handleClose(done) {
                this.$confirm('Seguro que quieres cerrar el formulario?')
                  .then(_ => {
                    done();
                  })
                  .catch(_ => {});
              },
            handleselect: function (a, b) {
            },
            logout: function () {
                this.$confirm('Seguro que quieres salir ?', 'Confirmation', {
                }).then(() => {
                    this.$auth.logout({
                        makeRequest: true,
                        redirect: '/login'
                    });
                });
            },
            collapse:function(){
                this.collapsed = ! this.collapsed;
            },
            showMenu(i,status){
                this.$refs.menuCollapsed.getElementsByClassName('submenu-hook-'+i)[0].style.display=status?'block':'none';

            }
        },
        mounted() {

            var user = sessionStorage.getItem('user');
            if (user) {
                user = JSON.parse(user);
                this.sysUserName = user.name || '';
                this.sysUserAvatar = user.avatar || '';
            }

        }
    }

</script>


<style scoped lang="scss">
    $color-primary: #20a0ff;//#18c79c


    .container {
        position: absolute;
        top: 0px;
        bottom: 0px;
        width: 100%;
        .header {
            height: 60px;
            line-height: 60px;
            background: $color-primary;
            color:#fff;
            .userinfo {
                text-align: right;
                padding-right: 35px;
                float: right;
                .userinfo-inner {
                    cursor: pointer;
                    color:#fff;
                    img {
                        width: 40px;
                        height: 40px;
                        border-radius: 20px;
                        margin: 10px 0px 10px 10px;
                        float: right;
                    }
                }
            }
            .logo {
                //width:230px;
                height:60px;
                font-size: 22px;
                padding-left:20px;
                padding-right:20px;
                border-color: rgba(238,241,146,0.3);
                border-right-width: 1px;
                border-right-style: solid;
                img {
                    width: 40px;
                    float: left;
                    margin: 10px 10px 10px 18px;
                }
                .txt {
                    color:#fff;
                }
            }
            .logo-width{
                width:230px;
            }
            .logo-collapse-width{
                width:60px
            }
            .tools{
                padding: 0px 23px;
                width:14px;
                height: 60px;
                line-height: 60px;
                cursor: pointer;
            }
        }
        .main {
            display: flex;
            // background: #324057;
            position: absolute;
            top: 60px;
            bottom: 0px;
            overflow: hidden;
            aside {
                border : 1px solid #E5E7E9;
                background-color:withe;
                flex:0 0 230px;
                width: 230px;
                // position: absolute;
                // top: 0px;
                // bottom: 0px;
                .el-menu{
                    height: 100%;
                }
                .collapsed{
                    width:60px;
                    .item{
                        position: relative;
                    }
                    .submenu{
                        position:absolute;
                        top:0px;
                        left:60px;
                        z-index:99999;
                        height:auto;
                        display:none;
                    }

                }
            }
            .menu-collapsed{
                flex:0 0 60px;
                width: 60px;
            }
            .menu-expanded{
                flex:0 0 230px;
                width: 230px;
            }
            .content-container {
                // background: #f1f2f7;
                flex:1;
                // position: absolute;
                // right: 0px;
                // top: 0px;
                // bottom: 0px;
                // left: 230px;
                overflow-y: scroll;
                padding: 20px;
                .breadcrumb-container {
                    //margin-bottom: 15px;
                    .title {
                        width: 200px;
                        float: left;
                        color: #475669;
                    }
                    .breadcrumb-inner {
                        float: right;
                    }
                }
                .content-wrapper {
                    background-color: #fff;
                    box-sizing: border-box;
                }
            }
        }
    }
</style>
