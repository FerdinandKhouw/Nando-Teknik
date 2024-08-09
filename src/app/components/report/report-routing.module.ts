import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';
import { ReportComponent } from './report.component';
import { otentikasiGuard } from '../../otentikasi.guard';

const routes: Routes = [{ path: '', component: ReportComponent, canActivate:[otentikasiGuard] }];

@NgModule({
  imports: [RouterModule.forChild(routes)],
  exports: [RouterModule]
})
export class ReportRoutingModule { }
