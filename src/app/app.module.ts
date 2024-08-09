import { NgModule } from '@angular/core';
import { BrowserModule } from '@angular/platform-browser';
import { RouterModule, Routes } from '@angular/router';

import { AppRoutingModule } from './app-routing.module';
import { AppComponent } from './app.component';
import { FormsModule } from '@angular/forms';

import { provideHttpClient, withInterceptorsFromDi } from '@angular/common/http';
// import { CategoryComponent } from './components/category/category.component';
// import { ProductComponent } from './components/product/product.component';
// import { SupplierComponent } from './components/supplier/supplier.component';
// import { PurchaseComponent } from './components/purchase/purchase.component';
import { PurchasedetailComponent } from './components/purchasedetail/purchasedetail.component';
// import { SalesComponent } from './components/sales/sales.component';
import { SalesdetailComponent } from './components/salesdetail/salesdetail.component';
import { LoginComponent } from './pages/login/login.component';
import { HeaderComponent } from './pages/header/header.component';
import { ContentComponent } from './pages/content/content.component';
// import { DashboardComponent } from './pages/dashboard/dashboard.component';
// import { CustomerComponent } from './components/customer/customer.component';
// import { ReportComponent } from './components/report/report.component';
// import { ServiceproductComponent } from './components/serviceproduct/serviceproduct.component';


@NgModule({
  declarations: [
    AppComponent,
    // CategoryComponent,
    // ProductComponent,
    // SupplierComponent,
    // PurchaseComponent,
    PurchasedetailComponent,
    // SalesComponent,
    SalesdetailComponent,
    HeaderComponent,
    ContentComponent,
    // DashboardComponent,
    // CustomerComponent,
    // ReportComponent,
    // ServiceproductComponent,
    LoginComponent
  ],
  imports: [
    BrowserModule,
    FormsModule,
    AppRoutingModule
  ],
  providers: [
    provideHttpClient(withInterceptorsFromDi())
  ],
  bootstrap: [AppComponent]
})
export class AppModule { }
