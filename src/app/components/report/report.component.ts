import { Component } from '@angular/core';
import { DataService } from '../../service/data.service';

@Component({
  selector: 'app-report',
  templateUrl: './report.component.html',
  styleUrl: './report.component.css'
})
export class ReportComponent {
  start_date: string = '';
  end_date: string = '';
  report: any[] = [];

  constructor(private dataService: DataService) { }

  ngOnInit(): void { }

  getReportData() {
    if (this.start_date && this.end_date) {
      const params = { start_date: this.start_date, end_date: this.end_date };
      this.dataService.getReportData(params).subscribe((data: any) => {
        this.report = data;
      });
    }
  }
}
