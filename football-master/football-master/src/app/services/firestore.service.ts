import { Injectable } from '@angular/core';
import { AngularFirestore } from '@angular/fire/compat/firestore';
import { Result } from '../pages/results/models/result.model';
import { Observable } from 'rxjs';

@Injectable({
  providedIn: 'root'
})
export class FirestoreService {

  resultRef = this.db.collection('result');
  constructor(private db: AngularFirestore) { }

  addNewResult(result: Result) {
    this.resultRef.add(result);
  }

  getAllResults() {
    return this.resultRef.valueChanges({idField: 'id'}) as Observable<Result[]>;
  }

  deleteResult(result: Result) {
    this.resultRef.doc(result.id).delete();
  }

  updateResult(result: Result) {
    this.resultRef.doc(result.id).update(result);
  }
}
