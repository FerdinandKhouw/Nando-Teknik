import { Component, OnInit } from '@angular/core';
import { DataService } from '../../service/data.service';
import { Product } from '../../class/product';

@Component({
  selector: 'app-product',
  templateUrl: './product.component.html',
  styleUrl: './product.component.css'
})
export class ProductComponent {

  role: string | null=null;
  products:any;
  categories: any[] = [];

  product = new Product();

  constructor(private dataService:DataService) { }

  ngOnInit(): void {
    this.getProductData();
    this.loadCategory();
    this.role = sessionStorage.getItem('role');
  }

  getProductData() {
    this.dataService.getProductData().subscribe(res =>{
      this.products = res;
    });
  }

  loadCategory() {
    this.dataService.getCategoryData().subscribe((data: any) => {
      this.categories = data;
    });
  }

  insertProductData() {
    this.dataService.insertProductData(this.product).subscribe(res => {
      this.getProductData()
    });
  }
  
  deleteProductData(id: number): void {
    const confirmation = window.confirm('Are you sure you want to delete this product?');

    if (confirmation) {
        this.dataService.deleteProductData(id).subscribe(
            res => {
                // Handle success
                this.getProductData();
                window.alert('Product deleted successfully');
            },
            error => {
                // Handle error
                window.alert('Failed to delete product. Please try again.');
            }
        );
    } else {
        window.alert('Product deletion cancelled');
    }
}
}
