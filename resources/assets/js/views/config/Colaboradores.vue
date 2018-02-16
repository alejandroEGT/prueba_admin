<template>
	<div>
		<h3>Usuarios colaboradores</h3>

		<el-row>
			<el-col :span="24">
				<div class="grid-content bg-purple-light">
					<el-row :span="24" :gutter="20">
						<el-col :span="5" >
							<el-input placeholder="Nombre" v-model="input"></el-input>	
						</el-col>
						<el-col :span="2">
							<el-button type="primary" icon="el-icon-search">Buscar</el-button>
						</el-col>
						<el-col :offset="12" :span="2">
							<el-button type="primary" @click="dialogVisible = true" icon="fas fa-user-plus">Agregar colaborador</el-button>
						

							<el-dialog
							  title="Nuevo colaborador"
							  :visible.sync="dialogVisible"
							  width="30%"
							  :before-close="handleClose">
							  
									
								<el-form>
									<el-form-item label="Usuario">
									   <el-select v-model="form.value8" filterable placeholder="Buscar..">
									    <el-option
									      v-for="item in options"
									      :key="item.name"
									      :label="item.name"
									      :value="item.id">
											<el-row>
												<el-col :span="7">
													<img :src="item.avatar" height="35" width="35" >
												</el-col>
												<el-col :span="15">
													{{ item.name }}
												</el-col>
											</el-row>
											
									    </el-option>
									  </el-select>
									</el-form-item>
									
									<el-form-item label="Permisos">  
									   <el-select v-model="form.value3" disabled default-first-option>
									    <el-option 
									      v-for="item in permisos"
									      :key="item.id"
									      :label="item.permiso"
									      :value="item.id">
									    </el-option>
									  </el-select>
									</el-form-item>
									<el-form-item>
										<el-button @click="onSubmitUser"  >Agregar</el-button>
									</el-form-item>
								</el-form>



							  <span slot="footer" class="dialog-footer">
							    <el-button @click="dialogVisible = false">Cancel</el-button>
							    
							  </span>
							</el-dialog>
						</el-col>
					</el-row>
				</div>
			</el-col>
		</el-row>
		<hr>

		 <el-table
	      :data="tableData"
	      style="width: 100%">
	      <el-table-column
	        prop="name"
	        label="Nombre"
	        width="180">
	      </el-table-column>
	      <el-table-column
	        prop="permiso"
	        label="permiso"
	        width="180">
	      </el-table-column>
	      <el-table-column
	        prop="address"
	        label="Opciones">
	      </el-table-column>
	    </el-table>
	</div>
</template>

<script type="text/javascript">
	import { select_user, getPermisos } from '../../endpoints';
	export default {
		data(){
			return{
				 input:'',
				 dialogVisible: false,
				 tableData:[],
				  options4: [],
			      value8: '',
			      list: [],
			      loading: false,
			      options:[],
			      permisos:[],
			      form:{
			      	id_proyecto: this.$route.params.id,
			      	value8:'',
			      	value3:'Admin',
			      }
			      
				
			}
		},
		methods: {
			handleClose(done) {
	        	this.$confirm('Are you sure to close this dialog?')
	          	.then(_ => {
	           	 done();
	          	})
	          .catch(_ => {});
	      	},
	      	onSubmitUser(){
	      		axios.post('frontend/colaborador', this.form).then((response)=>{
	      			console.log(response);
	      			this.tableDatas();
	      		})
	      	}
	      	,
	      	tableDatas(){
	      		axios.get('frontend/colaborador/'+this.$route.params.id).then((res)=>{
	      			this.tableData = res.data;
	      		})
	      	}
      	
      
      
    },
    mounted() {

    	select_user().then((res)=>{
    		this.options = res.data;

    	});
    	getPermisos().then((res)=>{
    		this.permisos = res.data;
    	});

    	this.tableDatas();

      	
      	

    }
	}
</script>