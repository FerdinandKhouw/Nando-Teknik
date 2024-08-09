import { Component } from '@angular/core';

@Component({
  selector: 'app-dashboard',
  templateUrl: './dashboard.component.html',
  styleUrl: './dashboard.component.css'
})
export class DashboardComponent {
  role: string | null=null;

  constructor() { }

  ngOnInit(): void {
    this.role = sessionStorage.getItem('role');
    console.log("Role from sessionStorage:", this.role);
  }
}
