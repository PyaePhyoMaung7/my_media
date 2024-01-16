import axios from 'axios';
import {mapGetters} from 'vuex';


export default {
    name:'HomePage',
    data () {
        return {
            postList: [],
            categoryList: [],
            searchKey: '',
            tokenStatus: false,

           
        }
    },
    computed:{
        ...mapGetters(['storedToken','storedUserData']),
    },
    methods: {
        getAllPost () {
            axios.get('http://localhost:8000/api/allPostList').then((response)=>{
                this.postList = response.data.posts;

                this.getImagePath();
        });

        
        },
        loadCategories(){
            axios
            .get('http://localhost:8000/api/allCategoryList')
            .then((response)=>{
                this.categoryList = response.data.categories;

            })
            .catch((error)=>{
                console.log(error);
            })
        },

        search(){
            let search = {
                key: this.searchKey
            }

            axios.post('http://localhost:8000/api/post/search',search).then((response)=>{
                this.postList = response.data.searchData;

                this.getImagePath();
            })
        },
        categorySearch(searchKey){
            let search = {
                key: searchKey
            }; 
            axios.post('http://localhost:8000/api/category/search', search)
            .then((response)=>{
                this.postList = response.data.result;

                this.getImagePath();
                
            })
            .catch(error => console.log(error));
        },

        newsDetails(id){
            this.$router.push({
                name: 'newsDetails',
                query:{
                    newsId: id
                },
            })
        },

        home(){
            this.$router.push('/home')
        },

        login(){
            this.$router.push({
                name: 'login',
            })
        },

        logout(){
            this.$store.dispatch('setToken', null);
            this.login();
        },

        checkToken(){
           if( this.storedToken != null &&  this.storedToken != '' && this.storedToken != undefined){
                this.tokenStatus = true;
           }else{
                this.tokenStatus = false;
           }

        },

        getImagePath(){
            for (let i = 0; i < this.postList.length; i++) {
                if(this.postList[i].image !== null){
                    this.postList[i].image = 'http://localhost:8000/postImage/'+this.postList[i].image;
                }else{
                    this.postList[i].image = 'http://localhost:8000/default_image/default_image.jpg';
                }
                
            }
        },

    },
    mounted(){
        this.checkToken();
        this.getAllPost();
        this.loadCategories();
        
    }
  }