import { Component } from '@angular/core';
import { DataService } from '../../service/data.service';

@Component({
  selector: 'app-sales',
  templateUrl: './sales.component.html',
  styleUrl: './sales.component.css'
})
export class SalesComponent {
  customers: any[] = [];
  products: any[] = [];
  sales: any[] = [];

  sale = {
    customer_id: '',
    sale_date: '',
    total_amount: '',
    details: [
      {
        product_id: '',
        quantity: '',
        price: ''
      }
    ]
  };

  constructor (private dataService: DataService){

  }

  ngOnInit() {
    this.getCustomerData();
    this.getProductData();
    this.getSalesData();
  }

  getCustomerData() {
    this.dataService.getCustomerData().subscribe((data: any) => {
      this.customers = data;
    });
  }

  getProductData() {
    this.dataService.getProductData().subscribe((data: any) => {
      this.products = data;
    });
  }

  getSalesData() {
    this.dataService.getSalesData().subscribe((data: any) => {
      console.log('Fetched sales:', data);
      this.sales = data;
    });
  }

  insertSalesData() {
    this.dataService.insertSalesData(this.sale).subscribe((data: any) => {
      this.getSalesData(); // Update the sale list
      this.sale = {
        customer_id: '',
        sale_date: '',
        total_amount: '',
        details: [
          {
            product_id: '',
            quantity: '',
            price: ''
          }
        ]
      };
      window.alert('Sale added successfully');
    });
  }
  
  addDetail() {
    this.sale.details.push({
      product_id: '',
      quantity: '',
      price: ''
    });
  }

  removeDetail(index: number) {
    this.sale.details.splice(index, 1);
  }

  deleteSalesData(id: number): void {
    const confirmation = window.confirm('Are you sure you want to delete this sale?');

    if (confirmation) {
        this.dataService.deleteSalesData(id).subscribe(
            res => {
                this.getSalesData();
                window.alert('Sale deleted successfully');
            },
            error => {
                window.alert('Failed to delete sale. Please try again.');
            }
        );
    } else {
        window.alert('Sale deletion cancelled');
    }
  }
}
