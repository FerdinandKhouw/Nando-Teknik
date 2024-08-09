import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';
import { ServiceproductComponent } from './serviceproduct.component';
import { otentikasiGuard } from '../../otentikasi.guard';

const routes: Routes = [{ path: '', component: ServiceproductComponent, canActivate:[otentikasiGuard] }];

@NgModule({
  imports: [RouterModule.forChild(routes)],
  exports: [RouterModule]
})
export class ServiceproductRoutingModule { }
