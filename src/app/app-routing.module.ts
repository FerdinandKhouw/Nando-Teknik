import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';

import { LoginComponent } from './pages/login/login.component';
// import { CategoryComponent } from './components/category/category.component';
// import { ProductComponent } from './components/product/product.component';
// import { SupplierComponent } from './components/supplier/supplier.component';
// import { PurchaseComponent } from './components/purchase/purchase.component';
// import { DashboardComponent } from './pages/dashboard/dashboard.component';
// import { HeaderComponent } from './pages/header/header.component';
// import { ContentComponent } from './pages/content/content.component';
// import { CustomerComponent } from './components/customer/customer.component';
// import { SalesComponent } from './components/sales/sales.component';
// import { ReportComponent } from './components/report/report.component';
// import { ServiceproductComponent } from './components/serviceproduct/serviceproduct.component';

import { otentikasiGuard } from './otentikasi.guard';

const routes: Routes = [
  { path: '', redirectTo:'login', pathMatch:'full' },
  { path: 'login', component:LoginComponent},
  // { path: 'dashboard', component:DashboardComponent, canActivate:[otentikasiGuard] },
  // { path: 'header', component:HeaderComponent, canActivate:[otentikasiGuard] },
  // { path: 'content', component:ContentComponent, canActivate:[otentikasiGuard] },
  // { path: 'category', component:CategoryComponent, canActivate:[otentikasiGuard] },
  // { path: 'product', component:ProductComponent, canActivate:[otentikasiGuard] },
  // { path: 'supplier', component:SupplierComponent, canActivate:[otentikasiGuard] },
  // { path: 'customer', component:CustomerComponent, canActivate:[otentikasiGuard] },
  // { path: 'purchase', component:PurchaseComponent, canActivate:[otentikasiGuard] },
  // { path: 'sales', component:SalesComponent, canActivate:[otentikasiGuard] },
  // { path: 'service-product', component:ServiceproductComponent, canActivate:[otentikasiGuard] },
  // { path: 'report', component:ReportComponent, canActivate:[otentikasiGuard] },

  // Lazy Load
  { path: 'product', loadChildren: () => import('./components/product/product.module').then(m => m.ProductModule) },
  { path: 'customer', loadChildren: () => import('./components/customer/customer.module').then(m => m.CustomerModule) },
  { path: 'category', loadChildren: () => import('./components/category/category.module').then(m => m.CategoryModule) },
  { path: 'purchase', loadChildren: () => import('./components/purchase/purchase.module').then(m => m.PurchaseModule) },
  { path: 'report', loadChildren: () => import('./components/report/report.module').then(m => m.ReportModule) },
  { path: 'sales', loadChildren: () => import('./components/sales/sales.module').then(m => m.SalesModule) },
  { path: 'serviceproduct', loadChildren: () => import('./components/serviceproduct/serviceproduct.module').then(m => m.ServiceproductModule) },
  { path: 'supplier', loadChildren: () => import('./components/supplier/supplier.module').then(m => m.SupplierModule) },
  { path: 'dashboard', loadChildren: () => import('./pages/dashboard/dashboard.module').then(m => m.DashboardModule) },
];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule { }
