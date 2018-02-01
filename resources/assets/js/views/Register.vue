<template>
	<el-form :model="ruleForm2" status-icon  ref="ruleForm2" label-width="120px" class="demo-ruleForm register-container">
		<h3 class="title">Registro</h3>

 <el-form-item label="Nombre" prop="">
    <el-input type="text" v-model="ruleForm2.name" placeholder="Nombre" icon="fa fa-address-card" auto-complete="off"></el-input>
  </el-form-item>
   <el-form-item label="NickName" prop="">
    <el-input type="text" v-model="ruleForm2.nickname" placeholder="Nickname" icon="fa fa-address-card" auto-complete="off"></el-input>
  </el-form-item>
  <el-form-item label="Email" prop="">
    <el-input type="email" v-model="ruleForm2.email" placeholder="Email" icon="fa fa-envelope" auto-complete="off"></el-input>
  </el-form-item>
  
  <el-form-item label="Password" prop="pass">
  	 <el-col :span="12">
    	<el-input type="password" v-model="ruleForm2.password" placeholder="Password" icon="fa fa-key" auto-complete="off"></el-input>
	</el-col>
	 
	 <el-col :span="12">
    	<el-input type="password" v-model="ruleForm2.confirma" icon="fa fa-key" placeholder="Confirmar password"  auto-complete="off"></el-input>
	</el-col>
  </el-form-item>

  <el-form-item label="Sexo" prop="">
    <el-select v-model="ruleForm2.sex" placeholder="Seleccione su sexo">
      <el-option label="Femenino" value="1"></el-option>
      <el-option label="Masculino" value="2"></el-option>
    </el-select>
  </el-form-item>
  
  <el-form-item label="Edad" prop="">
    <el-input type="numeric" v-model="ruleForm2.age" placeholder="Edad" icon="fa fa-sort-numeric-asc" auto-complete="off"></el-input>
  </el-form-item>
  <el-form-item label="nacimiento" prop="">
        <el-date-picker type="date" placeholder="Nacimiento" icon="fa fa-birthday-cake" v-model="ruleForm2.birth" format="dd-MM-yyyy" style="width: 100%;"></el-date-picker>
  </el-form-item>

  <el-form-item label="Dirección" prop="">
    <el-input type="text" v-model="ruleForm2.address" placeholder="Dirección" icon="fa fa-map-marker" auto-complete="off"></el-input>
  </el-form-item>
 
  <el-form-item>
    <el-button type="primary" style="width:100%;" :loading="isSubmitting" icon="fa fa-sign-in" @click="submitForm('ruleForm2')">Registrar</el-button>
    
  </el-form-item>
</el-form>
</template>
<script>

  import util from '../common/js/util'
  import Errors from '../common/js/Errors';

  import { getUserListPage, addUser, editUser, removeUser } from '../endpoints';

  export default {
    data() {
      

      return {
      	//url:'frontend/',
      	isSubmitting: false,
        ruleForm2: {
          name:'',
          nickname:'',
          email:'', 	
          password: '',
          confirma:'',
          sex:'',
          age:'',
          birth:'',
          address:''

        },
        
      };
    },
    methods: {
      error(type, mensaje) {
        this.$notify.error({
          title: type,
          message: mensaje
        });
      },
      success(type, mensaje) {
        this.$notify.success({
          title: type,
          message: mensaje
        });
      },
      submitForm(formName) {
      	this.isSubmitting = true;
        this.$refs[formName].validate((valid) => {
          if (valid) {
              addUser(this.ruleForm2).then((response) => {
                  this.success('Success', 'Usuario registrado correctamente');
                  console.log(response);
                  this.isSubmitting = false;
              }).catch((error) => {

                this.error('error', 'Error en los datos, verificar bien');
                this.isSubmitting = false;
              });
             
          } else {
            console.log('error submit!!');
            return false;
          }
        });
      }
    }
  }
</script>
<style lang="scss" scoped>
.register-container {
  /*box-shadow: 0 0px 8px 0 rgba(0, 0, 0, 0.06), 0 1px 0px 0 rgba(0, 0, 0, 0.02);*/
  -webkit-border-radius: 5px;
  border-radius: 5px;
  -moz-border-radius: 5px;
  background-clip: padding-box;
  margin: 120px auto;
  width: 500px;
  padding: 30px ;
  background: #fff;
  border: 1px solid #eaeaea;
  box-shadow: 0 0 25px #cac6c6;
  .title {
    margin: 0px auto 40px auto;
    text-align: center;
    color: #505458;
  }
  
}
</style>