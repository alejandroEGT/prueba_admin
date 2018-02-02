<template>
	<div>
		<el-row>
			<el-col :span="24">
				<div class="box-grid">
					<el-form>
						<el-row :gutter="20" >
							<el-col :span="5" :md="5" :xs="5" :sm="5">
								<el-input
								    size="medium"
								    placeholder="Requerimientos"
								    v-model="input7">
								  </el-input>
							</el-col>
							<el-col :span="3" :md="3" :xs="5" :sm="5" >
								<el-button type="primary" icon="far fa-search">Buscar</el-button>
							</el-col>
							<el-col :span="6" :md="6" :xs="5" :sm="5">
								<el-button icon="fas fa-check" type="text">0 Abiertos</el-button>
								<el-button icon="fas fas fa-times" type="text">0 Cerrados</el-button>
							</el-col>
							<el-col :span="6" :md="7" :xs="6" :sm="6"  :offset="2">
								<el-popover
									  ref="popover5"
									  placement="top"
									  width="380"
									  v-model="visible2">
									
									  <div style="text-align: right; margin: 0">
									    
										  <el-input  v-model="input8">
										   
										    <el-button slot="append" icon="far fa-copy"></el-button>
										  </el-input>
									  </div>
								</el-popover>

								<el-button v-popover:popover5 class="slt" type="primary" icon="far fa-share">Compartir</el-button>
								<el-button class="slt" @click="action" type="primary" icon="fas fa-plus">Agregar</el-button>

							</el-col>
						</el-row>
					</el-form>	
				</div>
			</el-col>
		</el-row>

		<div v-if="seeTable" class="salto" >
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

		<div v-if="seeAdd">

			<el-row :gutter="20" >
				<el-col :span="15">
					<h3>Agregar requerimiento</h3>

					<el-form>
						<el-form-item class="espacio" >
						  <el-input
						    size="small"
						    placeholder="Titulo"
						    v-model="input9">
						  </el-input>
						</el-form-item>
		 			 <markdown-editor v-model="content" ref="markdownEditor"></markdown-editor>

		 			 	<el-button @click="seeAdd=false, seeTable=true" >Cerrar</el-button>
		  				<el-button type="primary">Crear</el-button>
					</el-form>
				</el-col>
				<el-col :span="5" :offset="2" >

					    <el-popover
						  ref="popover2"
						  placement="bottom"
						  title="Asignar personas"
						  width="200"
						  trigger="click"
						  content="this is content, this is content, this is content">

							 <el-autocomplete
						      class="inline-input"
						    
						      v-model="state1"
						      :fetch-suggestions="querySearch"
						      placeholder="Ingrese el nombre o er"
						      @select="handleSelect">
						      	
						      </el-autocomplete>

						</el-popover>

					<el-button type="text" v-popover:popover2 icon="fas fa-cog" >Asignación </el-button>
				</el-col>
			</el-row>
			 

  
		</div>
	</div>
</template>

<style>
  @import '~simplemde/dist/simplemde.min.css';
  .espacio{
  	margin-bottom: 10px;
  }
</style>

<script>

import markdownEditor from 'vue-simplemde/src/markdown-editor'

  export default {

    data() {
      return {
      	seeTable: true,
      	seeAdd: false,
      	links: [],
        state1: '',
      	input7:'',
      	content: '',
      	input8:'https://www.ejemplo.com/12jnjk312h3byudqwjkndqw" ',
      	input9:'',
        visible2: false,
      }
    },
    components: {
	    markdownEditor
	},
	methods:{
		querySearch(queryString, cb) {
        var links = this.links;
        var results = queryString ? links.filter(this.createFilter(queryString)) : links;
        // call callback function to return suggestions
        cb(results);
      }
      ,
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
      },
      action(){
      	this.seeAdd=true, 
      	this.seeTable=false
      }
	}
  }
</script>

<style type="text/css">
	.box-grid{
		padding: 10px;
		background: #F2F3F4;
		border-radius: 2px;
	}
	.slt{
		margin: 2px;
	}
	.salto{
		margin-top: 10px;
	}
</style>