<template>
	<div>
		
		<el-row class="border">
			<el-col :offset="20" :span='4' >
				<el-button @click="btn_minuta" type="primary" icon="fa fa-plus">Agregar minuta</el-button>
			</el-col>
		</el-row>

		<div v-if="seen" >
			
			<template >
			  <el-table
			    
			    style="width: 100%">
			    <el-table-column
			      type="index"
			      >
			    </el-table-column>
			    <el-table-column
			      prop="date"
			      label="Fecha"
			      width="180">
			    </el-table-column>
			    <el-table-column
			      prop="name"
			      label="Nombre"
			      width="180">
			    </el-table-column>
			    <el-table-column
			      prop="address"
			      label="Dirección">
			    </el-table-column>
			  </el-table>
			</template>
		</div>


		<div v-if="seenMinuta" >
			<h3>Información básica</h3>
			
			<el-form ref="form" :model="form">
					<el-form-item label="Titulo">
					    <el-input v-model="form.titulo"></el-input>
					 </el-form-item>
					 <el-row :gutter="20" >
					 	<el-col :span="5" >
					 		<el-form-item label="Fecha" >
					 			<el-date-picker
							      v-model="form.fecha"
							      type="date"
							      placeholder="Fecha">
							    </el-date-picker>
					 		</el-form-item>
					 	</el-col>
					 	<el-col :span="5" >
					 		<el-form-item label="Hora inicio">
									<el-time-select
									  v-model="form.horaInicio"
									  :picker-options="{
									    start: '08:30',
									    step: '00:15',
									    end: '18:30'
									  }"
									  placeholder="Hora inicio">
									</el-time-select>
					 		</el-form-item>
					 	</el-col>
					 	<el-col :span="5" >
					 		<el-form-item label="Hora fin">
					 			<el-time-select
									  v-model="form.horaFin"
									  :picker-options="{
									    start: '08:30',
									    step: '00:15',
									    end: '18:30'
									  }"
									  placeholder="Hora fin">
									</el-time-select>
					 		</el-form-item>
					 	</el-col>
					 </el-row>

					 <el-form-item label="lugar">
					 		<el-input  v-model="form.lugar"></el-input>
					 </el-form-item>

					 <h3>Personas</h3>

					 <el-form-item label="Persona">
					 	<el-row>
					 		<el-col :span="24" >
					 			 <el-autocomplete size="medium"
								      class="inline-input"
								      v-model="selectPersona"
								      :fetch-suggestions="querySearch"
								      placeholder="Persona"
								      @select="handleSelect"
								    ></el-autocomplete>
								    <el-button icon="fa fa-user-plus" type="primary">Agregar</el-button>
					 		</el-col>
					 		
					 	</el-row>
					 </el-form-item>
					 <template >
						  <el-table
						    
						    style="width: 100%">
						    <el-table-column
						      type="index"
						      >
						    </el-table-column>
						   
						    <el-table-column
						      prop="name"
						      label="Nombre"
						      >
						    </el-table-column>
						    
						  </el-table>
					</template>

					<h3>Desarrollo</h3>

					<el-form-item>
						<trix-vue></trix-vue>
					</el-form-item>

					<h3>Compromiso</h3>

					<el-row :gutter="20">
						<el-col :span="5">
							<el-form-item label="Persona">
								<el-select v-model="form.selectPersona" placeholder="please select your zone">
							      <el-option label="Zone one" value="shanghai"></el-option>
							      <el-option label="Zone two" value="beijing"></el-option>
							    </el-select>
							</el-form-item>
						</el-col>

						<el-col :span="5">
								<el-form-item label="Fecha" >
					 			<el-date-picker
							      v-model="form.fecha2"
							      type="date"
							      placeholder="Fecha">
							    </el-date-picker>
					 		</el-form-item>
						</el-col>
					</el-row>

					<el-form-item label="Descripción">
						<el-input
						  type="textarea"
						  :rows="2"
						  placeholder="Descripción del compromiso"
						  v-model="form.descripcion">
						</el-input>
					</el-form-item>
					 <el-button type="primary" plain>Agregar</el-button>
					<br><br>
					 <template >
					  <el-table
					    
					    style="width: 100%">
					    <el-table-column
					      type="index"
					      >
					    </el-table-column>
					    <el-table-column
					      prop="name"
					      label="Nombre"
					      width="180">
					    </el-table-column>
					    <el-table-column
					      prop="address"
					      label="Compromiso">
					    </el-table-column>
					     <el-table-column
					      prop="date"
					      label="Fecha"
					      width="180">
					    </el-table-column>
					  </el-table>
					</template>

					<h3>Estado</h3>
					
					<el-row>
						<el-col :span="5" >
							<el-form-item label="Opción" >

								<el-select v-model="form.selectPersona" placeholder="please select your zone">
							      <el-option label="Zone one" value="shanghai"></el-option>
							      <el-option label="Zone two" value="beijing"></el-option>
							    </el-select>
							
					</el-form-item>
						</el-col>
					</el-row>

					<el-button type="default" @click="btn_cerrar"  round>Cancelar</el-button>
					<el-button type="primary" round>Crear</el-button>

			</el-form>

		</div>
	</div>
</template>

<script type="text/javascript">
import { TrixVue } from '../src/index.js'
	export default{
		components: {
	      TrixVue,
	    },
		data(){
			return{
				seen:true,
				seenMinuta:false,
				links: [],
				selectPersona:'',
				 form: {
			          titulo: '',
			          fecha:'',
			          fecha2:'',
			          horaInicio:'',
			          horaFin:'',
			          lugar:'',
			          personas:[],
			          selectPersona:'',
			          descripcion:''
			         
			        }
				
			}
		},
		methods:{
			btn_cerrar(){
				this.seen = true;
				this.seenMinuta = false;
			},
			btn_minuta(){
				this.seen=false;
				this.seenMinuta=true;
			},
			 querySearch(queryString, cb) {
		        var links = this.links;
		        var results = queryString ? links.filter(this.createFilter(queryString)) : links;
		        // call callback function to return suggestions
		        cb(results);
		     },
		     createFilter(queryString) {
		        return (link) => {
		          return (link.value.toLowerCase().indexOf(queryString.toLowerCase()) === 0);
		        };
		      },
		     loadAll() {
		        return [
		          { "value": "vue", "link": "https://github.com/vuejs/vue" },
		          { "value": "element", "link": "https://github.com/ElemeFE/element" },
		          { "value": "cooking", "link": "https://github.com/ElemeFE/cooking" },
		          { "value": "mint-ui", "link": "https://github.com/ElemeFE/mint-ui" },
		          { "value": "vuex", "link": "https://github.com/vuejs/vuex" },
		          { "value": "vue-router", "link": "https://github.com/vuejs/vue-router" },
		          { "value": "babel", "link": "https://github.com/babel/babel" }
		         ];
		      },
		     handleSelect(item) {
		        console.log(item);
		      }
		},
		  mounted() {
			      this.links = this.loadAll();
			 }
	}
</script>

<style type="text/css">
	.border{
		margin: 10px;
		padding: 10px;
		border-radius: 5px;
		border: 1px solid #D5DBDB;
	}
</style>