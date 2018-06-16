import Login from '../components/login/Login'
import Register from '../components/login/Register'
import Main from '../components/Main'
import PublicHome from '../components/PublicHome'
import ChatPage from '../components/chat/ChatPage'

export const routes = [
    {path: '/home', component: PublicHome, name:'home'},
    {path: '/login', component: Login, name: 'login'},
    {path: '/register', component: Register, name: 'register'},
    {path: '/main', component: Main, name: 'main', meta: {requireAuth: true}},
    {path: '/chat', component: ChatPage, name: 'chat', meta: {requireAuth: true}},

    {path: '*', redirect: {name: 'home'}}
];