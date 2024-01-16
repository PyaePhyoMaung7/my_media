<template>
    <div class="d-flex justify-content-center py-3">
        <p class="btn bg-danger text-white btn-sm mr-4" @click="home()">Home</p>
        <p class="btn bg-dark text-white btn-sm" @click="logout()">Log out</p>
    </div>

    <div class="container col-6 my-5 p-4 rounded rounded-lg shadow-sm">
        <div v-if="userStatus" class="alert alert-danger" role="alert">
            The Credentials Do Not Match!
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Email address</label>
            <input v-model="userData.email" type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Password</label>
            <input v-model="userData.password" type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
        </div>
        <button @click="accountLogin()" type="button" class="btn btn-primary">Log in</button>    
    </div>


</template>

<script src="../js/login.js"></script>


