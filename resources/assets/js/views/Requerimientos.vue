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
								<el-button class="slt" @click="seeAdd=true" type="primary" icon="fas fa-plus">Agregar</el-button>

							</el-col>
						</el-row>
					</el-form>	
				</div>
			</el-col>
		</el-row>

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

		 			 	<el-button @click="seeAdd=false" >Cerrar</el-button>
		  				<el-button type="primary">Crear</el-button>
					</el-form>
				</el-col>
				<el-col :span="5" >
					<h3>Agregar requerimiento</h3>
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
      	seeAdd: false,
      	input7:'',
      	 content: '',
      	input8:'https://www.ejemplo.com/12jnjk312h3byudqwjkndqw" ',
      	input9:'',
        visible2: false,
      }
    },
    components: {
	    markdownEditor
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

</style>