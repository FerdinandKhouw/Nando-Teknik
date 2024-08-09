import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';
import { CategoryComponent } from './category.component';
import { otentikasiGuard } from '../../otentikasi.guard';

const routes: Routes = [{ path: '', component: CategoryComponent, canActivate:[otentikasiGuard] }];

@NgModule({
  imports: [RouterModule.forChild(routes)],
  exports: [RouterModule]
})
export class CategoryRoutingModule { }
