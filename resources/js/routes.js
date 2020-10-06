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


export default [{
        path: '/',
        component: login,
        name: 'login'
    },
    {
        path: '/sales',
        component: sales,
        name: 'sales'
    },
    {
        path: '/saleshistory',
        component: saleshistory,
        name: 'saleshistory'
    },
    {
        path: '/book',
        component: book,
        name: 'book'
    },
    {
        path: '/booklist',
        component: booklist,
        name: 'booklist'
    },
    {
        path: '/consignment',
        component: consignment,
        name: 'consignment'
    },
    {
        path: '/newconsignment',
        component: consignmentCreate,
        name: 'newconsignment'
    },
    {
        path: '/viewconsignment',
        component: viewconsignment,
        name: 'viewconsignment'
    },
    {
        path: '/supplier',
        component: supplier,
        name: 'supplier'
    },
    {
        path: '/users',
        component: users,
        name: 'users'
    },
    {
        path: '/salesSum',
        component: salesSum,
        name: 'salesSum'
    },
    {
        path: '/salesState',
        component: salesState,
        name: 'salesState'
    },
    {
        path: '/stock',
        component: stock,
        name: 'stock'
    },
    {
        path: '/databackup',
        component: databackup,
        name: 'databackup'
    },

]