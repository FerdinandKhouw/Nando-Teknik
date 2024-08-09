import { Component, OnInit } from '@angular/core';
import { DataService } from '../../service/data.service';

@Component({
  selector: 'app-purchase',
  templateUrl: './purchase.component.html',
  styleUrls: ['./purchase.component.css']
})
export class PurchaseComponent implements OnInit {
  suppliers: any[] = [];
  products: any[] = [];
  purchases: any[] = [];

  purchase = {
    supplier_id: '',
    purchase_date: '',
    total_amount: '',
    details: [
      {
        product_id: '',
        quantity: '',
        price: ''
      }
    ]
  };

  constructor(private dataService: DataService) { }

  ngOnInit() {
    this.getSupplierData();
    this.getProductData();
    this.getPurchaseData();
  }

  getSupplierData() {
    this.dataService.getSupplierData().subscribe((data: any) => {
      this.suppliers = data;
    });
  }

  getProductData() {
    this.dataService.getProductData().subscribe((data: any) => {
      this.products = data;
    });
  }

  getPurchaseData() {
    this.dataService.getPurchaseData().subscribe((data: any) => {
      console.log('Fetched purchases:', data);
      this.purchases = data;
    });
  }

  insertPurchaseData() {
    this.dataService.insertPurchaseData(this.purchase).subscribe((data: any) => {
      this.getPurchaseData(); // Update the purchase list
      this.purchase = {
        supplier_id: '',
        purchase_date: '',
        total_amount: '',
        details: [
          {
            product_id: '',
            quantity: '',
            price: ''
          }
        ]
      };
      window.alert('Purchase added successfully');
    });
  }

  addDetail() {
    this.purchase.details.push({
      product_id: '',
      quantity: '',
      price: ''
    });
  }

  removeDetail(index: number) {
    this.purchase.details.splice(index, 1);
  }

  deletePurchaseData(id: number): void {
    const confirmation = window.confirm('Are you sure you want to delete this purchase?');

    if (confirmation) {
        this.dataService.deletePurchaseData(id).subscribe(
            res => {
                this.getPurchaseData();
                window.alert('Purchase deleted successfully');
            },
            error => {
                window.alert('Failed to delete purchase. Please try again.');
            }
        );
    } else {
        window.alert('Purchase deletion cancelled');
    }
  }
}
