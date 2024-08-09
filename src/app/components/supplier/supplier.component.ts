import { Component, OnInit } from '@angular/core';
import { DataService } from '../../service/data.service';
import { Supplier } from '../../class/supplier';

@Component({
  selector: 'app-supplier',
  templateUrl: './supplier.component.html',
  styleUrl: './supplier.component.css'
})
export class SupplierComponent {

  suppliers:any;
  supplier = new Supplier();

  constructor(private dataService:DataService) {}

  ngOnInit(): void{
    this.getSupplierData();
  }

  getSupplierData() {
    this.dataService.getSupplierData().subscribe(res =>{
      this.suppliers = res;
    });
  }

  insertSupplierData() {
    this.dataService.insertSupplierData(this.supplier).subscribe(res => {
      this.getSupplierData()
      window.alert('Supplier added successfully');
    });
  }

  deleteSupplierData(id: number): void {
    const confirmation = window.confirm('Are you sure you want to delete this supplier?');

    if (confirmation) {
        this.dataService.deleteSupplierData(id).subscribe(
            res => {
                // Handle success
                this.getSupplierData();
                window.alert('Supplier deleted successfully');
            },
            error => {
                // Handle error
                window.alert('Failed to delete supplier. Please try again.');
            }
        );
    } else {
        window.alert('Supplier deletion cancelled');
    }
}
}