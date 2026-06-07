import test from 'node:test'
import assert from 'node:assert/strict'
import { sharedContractNotes, sharedModelFolders } from '../src/index.js'

test('exports shared model folders', () => {
  assert.equal(Array.isArray(sharedModelFolders), true)
  assert.equal(sharedModelFolders.includes('students'), true)
})

test('exports bootstrap contract notes', () => {
  assert.equal(sharedContractNotes.status, 'bootstrap')
})
