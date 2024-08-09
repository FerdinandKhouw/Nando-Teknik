import { ComponentFixture, TestBed } from '@angular/core/testing';

import { PurchasedetailComponent } from './purchasedetail.component';

describe('PurchasedetailComponent', () => {
  let component: PurchasedetailComponent;
  let fixture: ComponentFixture<PurchasedetailComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      declarations: [PurchasedetailComponent]
    })
    .compileComponents();

    fixture = TestBed.createComponent(PurchasedetailComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
