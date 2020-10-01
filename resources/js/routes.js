
import login from "./components/login"
import dashboard from "./components/Dashboard"
import book from "./components/Book"
import booklist from "./components/Booklist"
import consignment from "./components/Consignment"
import newconsignment from "./components/NewConsignment"
import consignmentCreate from "./components/consignmentCreate"
import profile from "./components/Profile"
import sales from "./components/Sales"
import supplier from "./components/Supplier"
import users from "./components/Users"


export default [
    {
        path: '/',
        component: login,
        name:'login'
    },
    {
        path: '/dashboard',
        component: dashboard,
        name:'dashboard'
    },
    {
        path: '/book',
        component: book,
        name:'book'
    },
    {
        path: '/booklist',
        component: booklist,
        name:'booklist'
    },
    {
        path: '/consignment',
        component: consignment,
        name:'consignment'
    },
    {
        path: '/newconsignment',
        component: consignmentCreate,
        name:'newconsignment'
    },
    {
        path: '/profile',
        component: profile,
        name:'profile'
    },
    {
        path: '/sales',
        component: sales,
        name:'sales'
    },
    {
        path: '/supplier',
        component: supplier,
        name:'supplier'
    },
    {
        path: '/users',
        component: users,
        name:'users'
    },




    
]