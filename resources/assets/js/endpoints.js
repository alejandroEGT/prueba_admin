import axios from 'axios';

let base = '/frontend';

export const requestLogin = params => { return axios.post(`/login`, params).then(res => res.data); };

export const getUserListPage = params => { return axios.get(`${base}/users`, { params: params }); };

export const addUser = params => { return axios.post(`${base}/users`, params); };

export const removeUser = params => { return axios.delete(`${base}/users/${params.id}`, { params: params }); };

export const editUser = params => { return axios.put(`${base}/users/${params.id}`, params); };

export const saludo = params => { return axios.post(`saludo`, params).then(res => res.data); };

export const getUserAuth = params => { return axios.get(`${base}/getUserAuth`);};

export const submitProyecto = params => { return axios.post(`${base}/proyecto`, params) };

export const listarproyecto = params => { return axios.get(`${base}/proyecto`);};
export const getProyecto = params => {return axios.get(`${base}/proyecto/${params}`, {params: params})};

//export const auth = params => { return axios.get(`${base}/getUser`, params) };