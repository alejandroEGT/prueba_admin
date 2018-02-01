<template>
	<div>
		<el-row>
			<el-col :span="14" class="box">
				<label class="salto"><span class="fa fa-plus"></span> Agregar elemento </label>
					

    			<div class="wrap">
						
						 <el-radio-group v-model="radio3" @change="change" >
					      <el-radio-button label="Archivo" >
					      		<i class="fa fa-file" aria-hidden="true"></i>
					      </el-radio-button>
					      <el-radio-button label="Carpeta" >
					      		<i class="fa fa-folder-open" aria-hidden="true"></i>
					      </el-radio-button>
					 
					    </el-radio-group>
				
				</div>
  
			</el-col>
		</el-row>

		<br>
		<div v-if="seenArchivo">
			<div>
      			<h3>Agregar repositorio</h3>

			     <el-form ref="form" :model="form">		
						<el-form-item>
						    <el-input v-model="form.name" placeholder="Nombre"></el-input>
						 </el-form-item>
			     		<trix-vue></trix-vue>
				
						 <el-form-item>   
						 	<el-button style="margin-top:10px" type="primary">Upload<i class="el-icon-upload el-icon-right"></i></el-button>
						 </el-form-item> 

						 <el-form-item label="permisos para todos" >
						 		<el-switch v-model="value1">
								</el-switch>
						 </el-form-item>

						 <div v-if="value1 == false">
				     	
						     	<div>
						     		 <el-autocomplete
									      class="inline-input"
									      v-model="state1"
									      :fetch-suggestions="querySearch"
									      placeholder="Buscar persona"
									      @select="handleSelect"
									></el-autocomplete>
						     		 
						     		 <el-autocomplete
									      class="inline-input"
									      v-model="state1"
									      :fetch-suggestions="querySearch"
									      placeholder="Buscar equipo"
									      @select="handleSelect"
									 ></el-autocomplete>
						     		 
						     	</div>
						     	
						 </div>
				
						<br>
			      
			  			<el-button type="primary">Guardar</el-button>
			  			<el-button @click="btnCancel" >Cancelar</el-button>
			     </el-form>
    		</div>
		</div>

		<div v-if="seenCarpeta">
			<div>
				<el-form>
					  <el-form-item>
					  		<el-input v-model="form.name" placeholder="Nombre"></el-input>
					  </el-form-item>


					  <el-button @click="btnCancel" >Cancelar</el-button>
  					  <el-button type="primary">Primary</el-button>
				</el-form>
			</div>
		</div>
		<div v-if="seen" >
			<h3>Inicio </h3>
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
				 seen: true,
				 seenArchivo: false,
				 seenCarpeta:false,
				 value1:true,
				 radio3: 'New York',
				  form: {
			          name: '',
			          region: '',
			          date1: '',
			          date2: '',
			          delivery: false,
			          type: [],
			          resource: '',
			          desc: ''
			        }
			}
		},
		
		methods:{
			change(){
				console.log(this.radio3);
				if (this.radio3 == "Archivo") {
					this.chekArchivo();
				}
				if (this.radio3 == "Carpeta") {
					this.checkCarpeta();
				}
			},
			btnCancel(){
				this.seenCarpeta = false;
				this.seenArchivo = false;
				this.seen = true;
				this.radio3 = ""
				
			},
			chekArchivo(){
				this.seen = false;
				this.seenCarpeta = false;
				this.seenArchivo = true;
			},
			checkCarpeta(){
				this.seen = false;
				this.seenArchivo = false;
				this.seenCarpeta = true;
			}
		}
	}
</script>

<style type="text/css">
	
	.box{
		border-radius: 5px;
		padding: 15px;
		border: 1px solid #B2BABB;
	}
	
	.wrap {
	  width: 90%;
	  max-width: 1000px;
	  margin-top: 10px; }

	.info {
	  text-align: center;
	  padding: 20px;
	  color: #001F3F;
	  border-bottom: 1px solid #ccc; }
	  .info p {
	    margin-top: 20px; }

	.formulario {
	  /* --------------------------------------- */
	  /* ----- Radio Button */
	  /* --------------------------------------- */
	  /* --------------------------------------- */
	  /* ----- Checkbox */
	  /* --------------------------------------- */ }
	 
	  .formulario .radio label{
	    display: inline-block;
	    cursor: pointer;
	    color: #black;
	    position: relative;
	    padding: 5px 15px 5px 51px;
	    font-size: 1em;
	    border-radius: 5px;
	    -webkit-transition: all 0.3s ease;
	    -o-transition: all 0.3s ease;
	    transition: all 0.3s ease; }
	    .formulario .radio label:hover{
	      background: rgba(255, 65, 54, 0.1); }
	    .formulario .radio label:before{
	      content: "";
	      display: inline-block;
	      width: 17px;
	      height: 17px;
	      position: absolute;
	      left: 15px;
	      border-radius: 50%;
	      background: none;
	      border: 1px solid #CACFD2; }
	  .formulario input[type="radio"] {
	    display: none; }
	    .formulario input[type="radio"]:checked + label:before {
	      display: none; }
	    .formulario input[type="radio"]:checked + label {
	      padding: 5px 15px;
	      background: #3498DB;
	      border-radius: 2px;
	      color: #fff; }
	  .formulario .checkbox label:before {
	    border-radius: 3px; }
	  .formulario .checkbox input[type="checkbox"] {
	    display: none; }
	    .formulario .checkbox input[type="checkbox"]:checked + label:before {
	      display: none; }
	    .formulario .checkbox input[type="checkbox"]:checked + label {
	      background: black;
	      color: #fff;
	      padding: 5px 15px; }

</style>