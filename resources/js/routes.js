import login from "./components/login"
import sales from "./components/Sales"
import saleshistory from "./components/Sales-history"
import book from "./components/Book"
import booklist from "./components/Booklist"
import consignment from "./components/Consignment"
import viewconsignment from "./components/viewConsignment"
import consignmentCreate from "./components/consignmentCreate"
import supplier from "./components/Supplier"
import users from "./components/Users"
import salesState from "./components/SalesState"
import salesSum from "./components/SalesSum"
import stock from "./components/Stock"
import databackup from "./components/Backup"
import custInventory from "./components/Cust-inventory"
import suppInventory from "./components/Sup-inventory"


export default [{
        path: '/',
        component: login,
        name: 'login',
        beforeEnter(to,from,next){
            if(!localStorage.getItem('inventory'))
            {
                next();
            }else{
                next('/sales');
            }
        }
    },
    {
        path: '/sales',
        component: sales,
        name: 'sales',
        beforeEnter(to,from,next){
            if(localStorage.getItem('inventory'))
            {
                next();
            }else{
                next('/');
            }
        }
    },
    {
        path: '/saleshistory',
        component: saleshistory,
        name: 'saleshistory',
        beforeEnter(to,from,next){
            if(localStorage.getItem('inventory'))
            {
                next();
            }else{
                next('/');
            }
        }
    },
    {
        path: '/book',
        component: book,
        name: 'book',
        beforeEnter(to,from,next){
            if(localStorage.getItem('inventory'))
            {
                next();
            }else{
                next('/');
            }
        }
    },
    {
        path: '/booklist',
        component: booklist,
        name: 'booklist',
        beforeEnter(to,from,next){
            if(localStorage.getItem('inventory'))
            {
                next();
            }else{
                next('/');
            }
        }
    },
    {
        path: '/consignment',
        component: consignment,
        name: 'consignment',
        beforeEnter(to,from,next){
            if(localStorage.getItem('inventory'))
            {
                next();
            }else{
                next('/');
            }
        }
    },
    {
        path: '/newconsignment',
        component: consignmentCreate,
        name: 'newconsignment',
        beforeEnter(to,from,next){
            if(localStorage.getItem('inventory'))
            {
                next();
            }else{
                next('/');
            }
        }
    },
    {
        path: '/viewconsignment',
        component: viewconsignment,
        name: 'viewconsignment',
        beforeEnter(to,from,next){
            if(localStorage.getItem('inventory'))
            {
                next();
            }else{
                next('/');
            }
        }
    },
    {
        path: '/supplier',
        component: supplier,
        name: 'supplier',
        beforeEnter(to,from,next){
            if(localStorage.getItem('inventory'))
            {
                next();
            }else{
                next('/');
            }
        }
    },
    {
        path: '/users',
        component: users,
        name: 'users',
        beforeEnter(to,from,next){
            if(localStorage.getItem('inventory'))
            {
                next();
            }else{
                next('/');
            }
        }
    },
    {
        path: '/salesSum',
        component: salesSum,
        name: 'salesSum',
        beforeEnter(to,from,next){
            if(localStorage.getItem('inventory'))
            {
                next();
            }else{
                next('/');
            }
        }
    },
    {
        path: '/salesState',
        component: salesState,
        name: 'salesState',
        beforeEnter(to,from,next){
            if(localStorage.getItem('inventory'))
            {
                next();
            }else{
                next('/');
            }
        }
    },
    {
        path: '/stock',
        component: stock,
        name: 'stock',
        beforeEnter(to,from,next){
            if(localStorage.getItem('inventory'))
            {
                next();
            }else{
                next('/');
            }
        }
    },
    {
        path: '/databackup',
        component: databackup,
        name: 'databackup',
        beforeEnter(to,from,next){
            if(localStorage.getItem('inventory'))
            {
                next();
            }else{
                next('/');
            }
        }
    },
    {
        path: '/suppInventory',
        component: suppInventory,
        name: 'suppInventory',
        beforeEnter(to,from,next){
            if(localStorage.getItem('inventory'))
            {
                next();
            }else{
                next('/');
            }
        }
    },
    {
        path: '/custInventory',
        component: custInventory,
        name: 'custInventory',
        beforeEnter(to,from,next){
            if(localStorage.getItem('inventory'))
            {
                next();
            }else{
                next('/');
            }
        }
    },
]