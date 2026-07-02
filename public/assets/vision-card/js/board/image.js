// ════════════════════════════════════════════════
// INDUSTRY IMAGE
// ════════════════════════════════════════════════
import { state } from '../state.js';

export function getIndustryImage() {
  const ind = (state.industry || '').toLowerCase();
  const map = {
    'manufacturing': 'https://images.unsplash.com/photo-1565043666747-69f6646db940?w=900&q=75',
    'technology': 'https://images.unsplash.com/photo-1518770660439-4636190af475?w=900&q=75',
    'saas': 'https://images.unsplash.com/photo-1518770660439-4636190af475?w=900&q=75',
    'it & software': 'https://images.unsplash.com/photo-1558494949-ef010cbdcc31?w=900&q=75',
    'healthcare': 'https://images.unsplash.com/photo-1576091160399-112ba8d25d1d?w=900&q=75',
    'retail': 'https://images.unsplash.com/photo-1441986300917-64674bd600d8?w=900&q=75',
    'hospitality': 'https://images.unsplash.com/photo-1566073771259-6a8506099945?w=900&q=75',
    'logistics': 'https://images.unsplash.com/photo-1586528116311-ad8dd3c8310d?w=900&q=75',
    'construction': 'https://images.unsplash.com/photo-1504307651254-35680f356dfd?w=900&q=75',
    'education': 'https://images.unsplash.com/photo-1509062522246-3755977927d7?w=900&q=75',
    'financial': 'https://images.unsplash.com/photo-1460925895917-afdab827c52f?w=900&q=75',
    'trading': 'https://images.unsplash.com/photo-1451187580459-43490279c0fa?w=900&q=75',
    'global': 'https://images.unsplash.com/photo-1451187580459-43490279c0fa?w=900&q=75',
  };
  for (const key of Object.keys(map)) {
    if (ind.includes(key)) return map[key];
  }
  return 'https://images.unsplash.com/photo-1497366216548-37526070297c?w=900&q=75';
}
