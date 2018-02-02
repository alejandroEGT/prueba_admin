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
								    placeholder="Encuestas"
								    v-model="input7">
								  </el-input>
							</el-col>
							<el-col :span="3" :md="3" :xs="5" :sm="5" >
								<el-button type="primary" icon="far fa-search">Buscar</el-button>
							</el-col>
							<el-col :span="9" :md="6" :xs="5" :sm="5">
								<el-button icon="fas fa-check" type="text">0 Abiertos</el-button>
								<el-button icon="fas fas fa-times" type="text">0 Cerrados</el-button>
							</el-col>
							<el-col :span="3" :md="7" :xs="6" :sm="6"  :offset="3">

								
								<el-button class="slt" @click="see=true, seeTable=false" type="primary" icon="fas fa-plus">Agregar</el-button>

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
	

			<div v-if="see">
				<el-row>
					<el-col :span="20">
						<h3>Agregar encuesta</h3>

						<el-form>
							<el-row>
								<el-col :span="15">
									<el-input placeholder="Pregunta" v-model="input"></el-input>
								</el-col>
							</el-row>

							<br><br>

  							<el-form-item
							    v-for="(domain, index) in dynamicValidateForm.domains"
							    :key="domain.key"
							    :prop="'domains.' + index + '.value'"
							    :rules="{
							      required: true, message: 'domain can not be null', trigger: 'blur'
							    }"
							  >
							    <el-row>
								    <el-col :span="15">
								    	<el-input :placeholder="'Pregunta' + (index+1)" v-model="domain.value"></el-input>
								    </el-col>

									<el-col :span="5">
								    <!--<el-button @click.prevent="removeDomain(domain)">X</el-button>-->
									</el-col>
								</el-row>	
							</el-form-item>

							  <el-button type="text" @click="addDomain">Agregar otra opción</el-button>
								
								<br>
							   <el-button @click="see=false, seeTable=true" >Cerrar</el-button>
  							   <el-button type="primary">Crear</el-button>
 
						</el-form>
					</el-col>
				</el-row>
			</div>
		</div>
	
</template>

<script type="text/javascript">
	export default{
		data(){
			return{
				seeTable:true,
				preg:0,
				input:'',
				input7:'',
				see:false,
				dynamicValidateForm: {
		          domains: [{
		            key: 1,
		            value: ''
		          }],
		          opcion: '',
		        }
			}
		},
		methods:{
			removeDomain(item) {
        var index = this.dynamicValidateForm.domains.indexOf(item);
        if (index !== -1) {
          this.dynamicValidateForm.domains.splice(index, 1);
        }
      },
      addDomain() {
        this.dynamicValidateForm.domains.push({
          key: Date.now(),
          value: ''
        });
      }
		}
	}
</script>

<style type="text/css">
	.salto{
		margin-top:10px;
	}
</style>