import axios from 'axios';
import {mapGetters} from 'vuex';

export default{
    name: 'NewsDetails',
    data() {
        return {
            postId: '',
            post:{},
            viewCount: 0,
        }
    },
    computed:{
        ...mapGetters(['storedToken','storedUserData']),
    },
    methods: {
        loadPost(id){
            axios.post('http://localhost:8000/api/post/details',{postId: id})
            .then((response)=>{
                this.post = response.data.post;

                if(this.post.image !== null){
                    this.post.image = 'http://localhost:8000/postImage/'+this.post.image;
                }else{
                    this.post.image = 'http://localhost:8000/default_image/default_image.jpg';
                }
            })
        },
        back(){
            history.back();

            // this.$router.push({
            //     name:'homePage',
            // })
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
            this.$store.dispatch('setToken',null);
            this.login();
        },
        getViewCount(){
            let data = {
                'userId': this.storedUserData.id,
                'postId': this.postId,
            }
    
            axios.post('http://localhost:8000/api/post/actionLog',data).then((response)=>{
                this.viewCount = response.data.views;
            });
        }
    },
    mounted(){
        this.postId = this.$route.query.newsId;
        this.loadPost(this.postId);
        this.getViewCount();
        
    }
}