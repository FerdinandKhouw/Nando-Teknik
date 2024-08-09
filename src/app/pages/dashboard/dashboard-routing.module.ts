import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';
import { DashboardComponent } from './dashboard.component';
import { otentikasiGuard } from '../../otentikasi.guard';

const routes: Routes = [{ path: '', component: DashboardComponent, canActivate:[otentikasiGuard] }];

@NgModule({
  imports: [RouterModule.forChild(routes)],
  exports: [RouterModule]
})
export class DashboardRoutingModule { }
