import { Component } from '@angular/core';
import { DataService } from '../../service/data.service';
import { Customer } from '../../class/customer';

@Component({
  selector: 'app-customer',
  templateUrl: './customer.component.html',
  styleUrl: './customer.component.css'
})
export class CustomerComponent {

  customers:any;
  customer = new Customer();

  constructor(private dataService:DataService) {}

  ngOnInit(): void{
    this.getCustomerData();
  }

  getCustomerData() {
    this.dataService.getCustomerData().subscribe(res =>{
      this.customers = res;
    });
  }

  insertCustomerData() {
    this.dataService.insertCustomerData(this.customer).subscribe(res => {
      this.getCustomerData()
      window.alert('Customer added successfully');
    });
  }

  deleteCustomerData(id: number): void {
    const confirmation = window.confirm('Are you sure you want to delete this customer?');

    if (confirmation) {
        this.dataService.deleteCustomerData(id).subscribe(
            res => {
                this.getCustomerData();
                window.alert('Customer deleted successfully');
            },
            error => {
                window.alert('Failed to delete customer. Please try again.');
            }
        );
    } else {
        window.alert('Customer deletion cancelled');
    }
  }
}
