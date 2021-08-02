// Auth routes
import Login from './components/auth/Login';
import Register from './components/auth/Register';
import Forget from './components/auth/Forget';
import Home from './components/auth/Home';
import Logout from './components/auth/Logout';

// Employee files
import All from './components/Employee/All';
import Create from './components/Employee/Create';
import Edit from './components/Employee/Edit';

//Suppliers Files
import CreateSupplier from './components/Supplier/Create';
import Allsupplier from './components/Supplier/All';
import Editsupplier from './components/Supplier/Edit';

//category files
import CreateCategory from './components/Category/Create';
import AllCategory from './components/Category/All';
import EditCategory from './components/Category/Edit';

//customer files
import CreateCustomer from './components/Customer/Create';
import AllCustomer from './components/Customer/All';
import EditCustomer from './components/Customer/Edit';

//product files
import CreateProduct from './components/Product/Create';
import AllProduct from './components/Product/All';
import EditProduct from './components/Product/Edit';
import StockProduct from './components/Product/Stock';
import StockEdit from './components/Product/StockEdit';

//expense files
import CreateExpense from './components/Expense/Create';
import TodayExpense from './components/Expense/Today';
import EditExpense from './components/Expense/Edit';

//salary files
import Createsalary from './components/Salary/Create';
import Allsalary from './components/Salary/All';
import Editsalary from './components/Salary/Edit';
import Givensalary from './components/Salary/AllEmployee';
import ViewSalary from './components/Salary/ViewSalary';

// Pos file
import AllPos from './components/Pos/PointOfSale';

//product details
import TodayOrder from './components/Order/Today';
import ViewOrder from './components/Order/View';
import SerachOrder from './components/Order/Search';

export default{
    mode: 'history',
    routes: [
        {
            path: '/',
            component: Login,
            name:'/'
        },
        {
            path: '/register',
            component: Register
        },
        {
            path: '/forget',
            component: Forget
        },
        {
            path: '/home',
            component: Home
        },
        {
            path: '/logout',
            component: Logout
        },
        {
            path: '/all/employee',
            component: All
        },
        {
            path: '/create/employee',
            component: Create
        },
        {
            path: '/edit/employee/:id',
            component: Edit
        },
        {
            path: '/create/supplier',
            component: CreateSupplier
        },
        {
            path: '/all/supplier',
            component: Allsupplier
        },
        {
            path: '/edit/supplier/:id',
            component: Editsupplier
        },
        {
            path: '/create/category',
            component: CreateCategory
        },
        {
            path: '/all/category',
            component: AllCategory
        },
        {
            path: '/edit/category/:id',
            component: EditCategory
        },
        {
            path: '/create/product',
            component: CreateProduct
        },
        {
            path: '/all/product',
            component: AllProduct
        },
        {
            path: '/stock',
            component: StockProduct
        },
        {
            path: '/stock/edit/product/:id',
            component: StockEdit
        },
        {
            path: '/edit/product/:id',
            component: EditProduct
        },
        {
            path: '/create/expense',
            component: CreateExpense
        },
        {
            path: '/today/expense',
            component: TodayExpense
        },
        {
            path: '/edit/expense/:id',
            component: EditExpense
        },
        {
            path: '/create/salary/:id',
            component: Createsalary
        },
        {
            path: '/all/salary',
            component: Allsalary
        },
        {
            path: '/edit/salary/:id',
            component: Editsalary
        },
        {
            path: '/given/salary',
            component: Givensalary
        },
        {
            path: '/view/salary/:id',
            component: ViewSalary
        },
        {
            path: '/edit/customer/:id',
            component: EditCustomer
        },
        {
            path: '/create/customer/',
            component: CreateCustomer
        },
        {
            path: '/all/customer',
            component: AllCustomer
        },
        {
            path: '/pos',
            component: AllPos
        },
        {
            path: '/order',
            component: TodayOrder
        },
        {
            path: '/view/order/:id',
            component: ViewOrder
        },
        {
            path: '/search/order',
            component: SerachOrder
        }
  ]
}