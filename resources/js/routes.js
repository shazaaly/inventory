// import editStock from "./components/Product/editStock";

let login = require('./components/auth/login.vue').default;
let register = require('./components/auth/register.vue').default;
let forget = require('./components/auth/forget.vue').default;
let logout = require('./components/auth/logout.vue').default;
//END OF AUTHENTICATION

let home = require('./components/home.vue').default;
//Employee Component:
let storeEmployee = require('./components/Employee/create').default;
let employee = require('./components/Employee/index').default;
let editemployee = require('./components/Employee/edit').default;

//Employee Component:
let storeCustomer = require('./components/Customer/create').default;
let customer = require('./components/Customer/index').default;
let editCustomer = require('./components/Customer/edit').default;


//Supplier
let supplier = require('./components/Supplier/index').default;
let storeSupplier = require('./components/Supplier/create').default;
let editSupplier = require('./components/Supplier/edit').default;

let category = require('./components/Category/index').default;
let storeCategory = require('./components/Category/create').default;
let editCategory = require('./components/Category/edit').default;

let product = require('./components/Product/index').default;
let storeProduct = require('./components/Product/create').default;
let editProduct = require('./components/Product/edit').default;

//expense:
let expense = require('./components/Expense/index').default;
let storeExpense = require('./components/Expense/create').default;
let editExpense = require('./components/Expense/edit').default;

// expense:
let salary = require('./components/Salary/all_employee').default;
let paySalary = require('./components/Salary/edit').default;
let allsalary = require('./components/Salary/index').default;
let viewSalary = require('./components/Salary/view').default;
let editSalary = require('./components/Salary/editSalary').default;

//stock:
let stock = require('./components/Product/stock').default;
let editStock = require('./components/Product/editStock').default;

//POS
let pos = require('./components/pos/pos').default;



export const routes = [
    {path: '/', component: login, name: '/'},
    {path: '/register', component: register, name: 'register'},
    {path: '/forget', component: forget, name: 'forget'},
    {path: '/logout', component: logout, name: 'logout'},
    {path: '/home', component: home, name: 'home'},
    //Employee:
    {path: '/store-employee', component: storeEmployee, name: 'storeEmployee'},
    {path: '/employee', component: employee, name: 'employee'},
    {path: '/edit-employee/:id', component: editemployee, name: 'edit-employee'},
    //Suppliers:
    {path: '/supplier', component: supplier, name: 'supplier'},
    {path: '/store-supplier', component: storeSupplier, name: 'storeSupplier'},
    {path: '/edit-supplier/:id', component: editSupplier, name: 'edit-supplier'},
//    Categories
    {path: '/category', component: category, name: 'category'},
    {path: '/store-category', component: storeCategory, name: 'storeCategory'},
    {path: '/edit-category/:id', component: editCategory, name: 'edit-category'},

//Product:
    {path: '/product', component: product, name: 'product'},
    {path: '/store-product', component: storeProduct, name: 'storeProduct'},
    {path: '/edit-product/:id', component: editProduct, name: 'edit-product'},

    //expense:
    {path: '/expense', component: expense, name: 'expense'},
    {path: '/store-expense', component: storeExpense, name: 'storeExpense'},
    {path: '/edit-expense/:id', component: editExpense, name: 'edit-expense'},

    //salary:
    {path: '/given-salary', component: salary, name: 'given-salary'},
    {path: '/pay-salary/:id', component: paySalary, name: 'pay-salary'},
    {path: '/salary', component: allsalary, name: 'salary'},
    {path: '/view-salary/:id', component: viewSalary, name: 'view-salary'},
    {path: '/edit-salary/:id', component: editSalary, name: 'edit-salary'},

//   stock:
    {path: '/stock/', component: stock, name: 'stock'},
    {path: '/edit-stock/:id', component: editStock, name: 'edit-stock'},

    //Customer:
    {path: '/store-customer', component: storeCustomer, name: 'storeCustomer'},
    {path: '/customer', component: customer, name: 'customer'},
    {path: '/edit-customer/:id', component: editCustomer, name: 'edit-customer'},


    //POS:
    {path: '/pos', component: pos, name: 'pos'},


]
