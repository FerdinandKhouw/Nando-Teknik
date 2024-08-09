import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';

import { ServiceproductRoutingModule } from './serviceproduct-routing.module';
import { ServiceproductComponent } from './serviceproduct.component';
import { FormsModule } from '@angular/forms';


@NgModule({
  declarations: [
    ServiceproductComponent
  ],
  imports: [
    CommonModule,
    ServiceproductRoutingModule,
    FormsModule
  ]
})
export class ServiceproductModule { }
