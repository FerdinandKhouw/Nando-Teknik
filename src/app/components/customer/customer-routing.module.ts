import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';
import { CustomerComponent } from './customer.component';
import { otentikasiGuard } from '../../otentikasi.guard';

const routes: Routes = [{ path: '', component: CustomerComponent, canActivate:[otentikasiGuard] }];

@NgModule({
  imports: [RouterModule.forChild(routes)],
  exports: [RouterModule]
})
export class CustomerRoutingModule { }
