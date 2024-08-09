import { Component } from '@angular/core';
import { DataService } from '../../service/data.service';
import { ServiceProduct } from '../../class/service-product';

@Component({
  selector: 'app-serviceproduct',
  templateUrl: './serviceproduct.component.html',
  styleUrl: './serviceproduct.component.css'
})
export class ServiceproductComponent {

  services: any[] = [];
  products: any[] = [];
  customers: any[] = [];

  serviceProduct = {
    date: '',
    customer_id: '',
    product_id: '',
    quantity: '',
    remarks: ''
  };

  constructor(private dataService: DataService) { }

  ngOnInit(): void {
    // this.getProductData();
    this.getServiceProductData();
    this.loadProduct();
    this.loadCustomer();
  }

  getServiceProductData() {
    this.dataService.getServiceProductData().subscribe((data: any) => {
      this.services = data;
    });
  }

  loadProduct() {
    this.dataService.getProductData().subscribe((data: any) => {
      this.products = data;
    })
  }
  loadCustomer() {
    this.dataService.getCustomerData().subscribe((data: any) => {
      this.customers = data;
    })
  }
  insertServiceProductData() {
    this.dataService.insertServiceProductData(this.serviceProduct).subscribe((data: any) => {
      this.getServiceProductData();
      this.serviceProduct = {
        date: '',
        customer_id: '',
        product_id: '',
        quantity: '',
        remarks: ''
      };
      window.alert('Service Product added successfully');
    });
  }

  deleteServiceProductData(id: number): void {
    const confirmation = window.confirm('Are you sure you want to delete this service product?');

    if (confirmation) {
        this.dataService.deleteServiceProductData(id).subscribe(
            res => {
                this.getServiceProductData();
                window.alert('Service product deleted successfully');
            },
            error => {
                window.alert('Failed to delete service product. Please try again.');
            }
        );
    } else {
        window.alert('Service product deletion cancelled');
    }
  }
}
